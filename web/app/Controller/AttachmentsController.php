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
	 * shows only presentations and images without parent_id
	 *
	 * @return string
	 */
	public function admin_list() {
		$this->redirectIfNotAjax();

		$this->Attachment->recursive = 0;
		$videoTypeId = $this->Attachment->Type->field('id', array('Type.name' => 'video'));
		$list = $this->Attachment->find('all', array(
			'conditions' => array(
				'Attachment.user_id' => $this->Auth->user('id'),
				'Attachment.parent_id' => null,
				'Attachment.type_id !=' => $videoTypeId,
				'Attachment.status' => true
			)
		));

		$this->autoRender = false;
		return json_encode(array('list' => $list));
	}


	/**
	 * get data based on request
	 * images for presentation
	 *
	 * @return string
	 */
	public function admin_getDataFromRequest() {
		$this->redirectIfNotAjax();

		$this->Attachment->recursive = 0;

		$result = $this->Attachment->find('all', array(
			'conditions' => array(
				'Attachment.user_id' => $this->Auth->user('id'),
				'Attachment.status' => true,
				'OR' => array(
					'Attachment.id' => array_merge($this->request->data['image'], $this->request->data['text']),
					'AND' => array(
						'Attachment.parent_id' => $this->request->data['presentation'],
						'Attachment.parent_id !=' => null
					)
				)
			)
		));

		$this->autoRender = false;
		return json_encode($result);
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
	 * admin add method
	 *
	 * @param null $type
	 */
	public function admin_add($type = null) {
		if ($this->request->is('post')) {
			$this->Attachment->create();
			$this->request->data['Attachment']['user_id'] = $this->Auth->user('id');

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
		$typesConditions = array('Type.status' => true);

		if ($type) {
			$typesConditions['Type.name'] = $type;
		}

		$typeId = $this->Attachment->Type->field('id', $typesConditions);
		if (empty($typeId)) {
			$type = null;
		}
//		$parentAttachments = $this->Attachment->generateTreeList();
		$this->set(compact('users', 'typeId', 'parentAttachments', 'type'));
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

		if ($this->request->data['Attachment']['parent_id']) {
			$this->redirect(array('action' => 'index'));
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
	 * TODO: dorobit delete = unlink() ku obrazkom + thumbs, prezentaciam + obrazky, videam
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

	/**
	 * upload video to youtube and save it
	 */
	public function admin_uploadVideo() {
		$typeId = $this->Attachment->Type->field('id', array('Type.name' => 'video'));
		$action = 'uploadVideo';
		$token = null;
		$uniqueId = isset($this->request->query['id']) ? $this->request->query['id'] : null;
		$status = isset($this->request->query['status']) ? $this->request->query['status'] : null;

		// get token
		if ($this->request->is('post')) {
			$response = $this->Files->getYoutubeToken($this->request->data);

			if ($response->token != '') {
				$nextUrl = Router::url(array(
					'admin' => true,
					'controller' => 'attachments',
					'action' => 'uploadVideo',
				), true);
				$action = $response->url . '?nexturl=' . urlencode($nextUrl);
				$token = $response->token;
				$data = array(
					'name' => $this->request->data['Attachment']['name'],
					'text' => $this->request->data['Attachment']['text'],
					'type_id' => $this->request->data['Attachment']['type_id'],
					'user_id' => $this->Auth->user('id'),
					'status' => $this->request->data['Attachment']['status'],
				);
				$this->Session->write('Video', $data);
			}
		}

		// save uploaded video
		if ($uniqueId != '' && $status == 200 && $this->Session->check('Video')) {
			$this->request->data['Attachment'] = $this->Session->read('Video');
			$this->Session->delete('Video');
			$this->request->data['Attachment']['url'] = 'http://www.youtube.com/watch?v=' . $uniqueId;

			if ($this->Attachment->save($this->request->data)) {
				$this->Session->setFlash(__('The attachment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.'));
			}
		}

		$this->set(compact('action', 'token', 'typeId'));
	}


	/**
	 * only for inserted url
	 * in case of upload there is specific action admin_uploadVideo
	 *
	 * @return array
	 */
	private function getCorrectDataVideo() {
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
			$uid = $this->Auth->user('id');
			$this->saveFileFromUrl($uid);

			$urlWithoutSlash = substr($this->request->data['Attachment']['url'], 1);
			$this->createThumbnail($urlWithoutSlash);

			return $this->request->data;
		}

		$data = $this->uploadFiles('image');
		//todo: este tu dorobit, zeby sa uploadnute obrazky tiez mali thumbs

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

			$outputUrl = $folderUrl . DS . '%d.png';
			$source = $urlWithoutSlash;

			$shellTemplate = 'gs -dSAFER -dBATCH -dNOPAUSE -r200 -sDEVICE=png16m -sOutputFile=OUTPUT SOURCE';
			$script = str_replace('OUTPUT', $outputUrl, $shellTemplate);
			$script = str_replace('SOURCE', $source, $script);

			shell_exec($script);


			// make small thumbnail for each page
			$thumbnailFolderUrl = $folderUrl . DS . 'thumb';
			if (!is_dir($thumbnailFolderUrl)) {
				mkdir($thumbnailFolderUrl);
			}

			$thumbnailOutputUrl = $thumbnailFolderUrl . DS . '%d.png';
			$thumbailShellTemplate = 'gs -dSAFER -dBATCH -dNOPAUSE -r20 -sDEVICE=png16m -sOutputFile=OUTPUT SOURCE';
			$thumbnailScript = str_replace('OUTPUT', $thumbnailOutputUrl, $thumbailShellTemplate);
			$thumbnailScript = str_replace('SOURCE', $source, $thumbnailScript);

			shell_exec($thumbnailScript);
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

					if ($type == 'image') {
						$url = $relUrl . DS . $filename;
						$this->createThumbnail($url);
					}
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


	/**
	 * @param $fullUrl
	 */
	private function createThumbnail($fullUrl) {
		$urlInfo = pathinfo($fullUrl);
		$ext = $urlInfo['extension'];
		$sourceImage = null;

		switch ($ext) {
			case 'jpg':
			case 'jpeg':
				$sourceImage = imagecreatefromjpeg($fullUrl);
				break;
			case 'gif':
				$sourceImage = imagecreatefromstring(file_get_contents($fullUrl));
				break;
			case 'png':
				$sourceImage = imagecreatefrompng($fullUrl);
				break;
		}

		$width = imagesx($sourceImage);
		$height = imagesy($sourceImage);

		$desiredWidth = 200;
		$desiredHeight = floor($height * ($desiredWidth / $width));

		$virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);

		imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);

		$thumbDir = $urlInfo['dirname'] . DS . 'thumb';
		if (!is_dir($thumbDir)) {
			mkdir($thumbDir);
		}

		$thumbUrl = $thumbDir . DS . $urlInfo['basename'];

		switch ($ext) {
			case 'jpg':
			case 'jpeg':
				imagejpeg($virtualImage, $thumbUrl);
				break;
			case 'gif':
				imagegif($virtualImage, $thumbUrl);
				break;
			case 'png':
				imagepng($virtualImage, $thumbUrl);
				break;
		}
	}
}
