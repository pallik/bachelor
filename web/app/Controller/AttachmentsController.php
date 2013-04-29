<?php
App::uses('AppController', 'Controller');
/**
 * Attachments Controller
 *
 * @property FilesComponent $Files
 * @property Attachment $Attachment
 */
class AttachmentsController extends AppController {

	/**
	 * components
	 *
	 * @var array
	 */
	public $components = array('Files');

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->Attachment->recursive = 0;
		$this->paginate = array(
			'conditions' => array(
				'Attachment.user_id' => $this->Auth->user('id'),
				'Attachment.parent_id' => null
			)
		);
		$this->set('attachments', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Attachment->exists($id)) {
			throw new NotFoundException(__('Invalid attachment'));
		}
		$options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
		$this->set('attachment', $this->Attachment->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Attachment->create();
			$this->request->data['Attachment']['user_id'] = $this->Auth->user('id');

			$type = $this->Attachment->Type->field('name', array(
				'Type.id' => $this->request->data['Attachment']['type_id']));
			$correctDataFunction = 'getCorrectData' . ucfirst($type);

			$data = $this->$correctDataFunction();

			if (!empty($data) && $this->Attachment->saveMany($data)) {
				$this->Session->setFlash(__('The attachment has been saved'));
				if ($type == 'presentation') {
					$this->saveImagesForPresentation($this->Attachment->insertedIds);
				}
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.'));
			}
		}

		$users = $this->Attachment->User->find('list');
		$types = $this->Attachment->Type->find('list', array('conditions' => array('Type.status' => true)));
//		$parentAttachments = $this->Attachment->generateTreeList();
		$this->set(compact('users', 'types', 'parentAttachments'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->Attachment->exists($id)) {
			throw new NotFoundException(__('Invalid attachment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Attachment']['user_id'] = $this->Auth->user('id');
			if ($this->Attachment->save($this->request->data)) {
				$this->Session->setFlash(__('The attachment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
			$this->request->data = $this->Attachment->find('first', $options);
		}
		$users = $this->Attachment->User->find('list');
		$types = $this->Attachment->Type->find('list', array('conditions' => array('Type.status' => true)));
//		$parentAttachments = $this->Attachment->generateTreeList();
		$this->set(compact('users', 'types', 'parentAttachments'));
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Attachment->id = $id;
		if (!$this->Attachment->exists()) {
			throw new NotFoundException(__('Invalid attachment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Attachment->delete()) {
			$this->Session->setFlash(__('Attachment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attachment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


	private function getCorrectDataVideo() {
		//TODO
		return $this->request->data;
	}

	/**
	 * if isset url nothing to do
	 * else upload files and return many data to save
	 *
	 * @return array
	 */
	private function getCorrectDataImage() {
		if (!empty($this->request->data['Attachment']['url'])) {
			return $this->request->data;
		}

		$data = $this->uploadFiles('image');

		return $data;
	}

	/**
	 * uploadne prezentacie (prip. stiahne z url)
	 * rozbije prezentacie na obrazky a uploadne ich
	 *
	 * @return array
	 */
	private function getCorrectDataPresentation() {
		$uid = $this->Auth->user('id');

		if (!empty($this->request->data['Attachment']['url'])) {
			$this->saveFileFromUrl($uid);
			$data[] = $this->request->data['Attachment'];
		} else {
			$data = $this->uploadFiles('presentation');
		}


		foreach ($data as $presentation) {
			$urlWithoutSlash = substr($presentation['url'], 1);
			$pdfDir = pathinfo($urlWithoutSlash, PATHINFO_FILENAME);
			$folderUrl = 'uploads' . DS . $uid . DS . $pdfDir;

			if (!is_dir($folderUrl)) {
				mkdir($folderUrl);
			}

			$outputUrl = $folderUrl . DS . 'page%d.png';
			$source = $urlWithoutSlash;

			$shellTemplate = 'gs -dSAFER -dBATCH -dNOPAUSE -r300 -sDEVICE=png16m -sOutputFile=OUTPUT SOURCE';
			$script = str_replace('OUTPUT', $outputUrl, $shellTemplate);
			$script = str_replace('SOURCE', $source, $script);

			shell_exec($script);
		}


		return $data;
	}

	/**
	 * just pass away data, nothing to do
	 *
	 * @return array
	 */
	private function getCorrectDataText() {
		return $this->request->data;
	}

	/**
	 * @param $insertedIds
	 */
	private function saveImagesForPresentation($insertedIds) {

		$this->Attachment->recursive = -1;
		$data = $this->Attachment->findAllById($insertedIds);

		foreach ($data as $presentation) {
			$userId = $presentation['Attachment']['user_id'];
			$status = $presentation['Attachment']['status'];
			$typeId = 2; // image
			$parentId = $presentation['Attachment']['id'];

			$url = $presentation['Attachment']['url'];
			$urlRemovedExtension = pathinfo($url, PATHINFO_DIRNAME) . DS . pathinfo($url, PATHINFO_FILENAME);
			$dirUrl = substr($urlRemovedExtension, 1);

			$toSave = array();
			$images = $this->Files->getDirFiles($dirUrl);

			foreach ($images as $image) {
				$toSave[] = array(
					'user_id' => $userId,
					'status' => $status,
					'type_id' => $typeId,
					'parent_id' => $parentId,
					'name' => $image,
					'url' => $urlRemovedExtension . DS . $image
				);
			}

			$this->Attachment->create();
			$this->Attachment->saveMany($toSave);
		}

	}

	/**
	 * upload files
	 *
	 * @param $type
	 * @return array
	 */
	private function uploadFiles($type) {
		$uid = $this->Auth->user('id');
		$relUrl = 'uploads' . DS . $uid;
		$files = $this->request->data['Attachment']['files'];

		$typeId = $this->request->data['Attachment']['type_id'];
		$status = $this->request->data['Attachment']['status'];
		$userId = $this->request->data['Attachment']['user_id'];

		$folderUrl = WWW_ROOT . $relUrl;

		$results = array();


		if (!is_dir($folderUrl)) {
			mkdir($folderUrl);
		}


		if ($type == 'image') {
			$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
		} else {
			$permitted = array('application/pdf');
		}


		foreach ($files as $file) {
			if (!in_array($file['type'], $permitted)) {
				break;
			}

			if ($file['error'] == UPLOAD_ERR_OK) {
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$filename = String::uuid() . '.' . $ext;
				$fullUrl = $folderUrl . DS . $filename;

				if (move_uploaded_file($file['tmp_name'], $fullUrl)) {
					$results[] = array(
						'name' => $file['name'],
						'url' => DS . $relUrl . DS . $filename,
						'type_id' => $typeId,
						'status' => $status,
						'user_id' => $userId
					);
				}
			}
		}

		return $results;
	}

	/**
	 * donwload and save file from url
	 * update request->data
	 *
	 * @param $uid
	 */
	private function saveFileFromUrl($uid) {
		$source = $this->request->data['Attachment']['url'];
		$ext = pathinfo($source, PATHINFO_EXTENSION);
		$filename = String::uuid() . '.' . $ext;
		$dest = 'uploads' . DS . $uid . DS . $filename;
		file_put_contents($dest, file_get_contents($source));

		$this->request->data['Attachment']['url'] = DS . $dest;
	}
}
