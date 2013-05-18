<?php
App::uses('AppController', 'Controller');
/**
 * Timestamps Controller
 *
 * @property Timestamp $Timestamp
 */
class TimestampsController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Timestamp->recursive = 0;
		$this->set('timestamps', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Timestamp->exists($id)) {
			throw new NotFoundException(__('Invalid timestamp'));
		}
		$options = array('conditions' => array('Timestamp.' . $this->Timestamp->primaryKey => $id));
		$this->set('timestamp', $this->Timestamp->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Timestamp->create();
			if ($this->Timestamp->save($this->request->data)) {
				$this->Session->setFlash(__('The timestamp has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timestamp could not be saved. Please, try again.'));
			}
		}
		$attachments = $this->Timestamp->Attachment->find('list');
		$blocks = $this->Timestamp->Block->find('list');
		$this->set(compact('attachments', 'blocks'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Timestamp->exists($id)) {
			throw new NotFoundException(__('Invalid timestamp'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Timestamp->save($this->request->data)) {
				$this->Session->setFlash(__('The timestamp has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timestamp could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Timestamp.' . $this->Timestamp->primaryKey => $id));
			$this->request->data = $this->Timestamp->find('first', $options);
		}
		$attachments = $this->Timestamp->Attachment->find('list');
		$blocks = $this->Timestamp->Block->find('list');
		$this->set(compact('attachments', 'blocks'));
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
		$this->Timestamp->id = $id;
		if (!$this->Timestamp->exists()) {
			throw new NotFoundException(__('Invalid timestamp'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Timestamp->delete()) {
			$this->Session->setFlash(__('Timestamp deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Timestamp was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


	public function admin_saveAll() {
		$this->redirectIfNotAjax();

		$result = $this->Timestamp->saveMany($this->request->data);

		$this->autoRender = false;
		return json_encode($result);
	}
}
