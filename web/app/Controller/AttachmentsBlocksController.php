<?php
App::uses('AppController', 'Controller');
/**
 * AttachmentsBlocks Controller
 *
 * @property AttachmentsBlock $AttachmentsBlock
 */
class AttachmentsBlocksController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AttachmentsBlock->recursive = 0;
		$this->set('attachmentsBlocks', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AttachmentsBlock->exists($id)) {
			throw new NotFoundException(__('Invalid attachments block'));
		}
		$options = array('conditions' => array('AttachmentsBlock.' . $this->AttachmentsBlock->primaryKey => $id));
		$this->set('attachmentsBlock', $this->AttachmentsBlock->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AttachmentsBlock->create();
			if ($this->AttachmentsBlock->save($this->request->data)) {
				$this->Session->setFlash(__('The attachments block has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachments block could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AttachmentsBlock->exists($id)) {
			throw new NotFoundException(__('Invalid attachments block'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AttachmentsBlock->save($this->request->data)) {
				$this->Session->setFlash(__('The attachments block has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachments block could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AttachmentsBlock.' . $this->AttachmentsBlock->primaryKey => $id));
			$this->request->data = $this->AttachmentsBlock->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AttachmentsBlock->id = $id;
		if (!$this->AttachmentsBlock->exists()) {
			throw new NotFoundException(__('Invalid attachments block'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AttachmentsBlock->delete()) {
			$this->Session->setFlash(__('Attachments block deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attachments block was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AttachmentsBlock->recursive = 0;
		$this->set('attachmentsBlocks', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AttachmentsBlock->exists($id)) {
			throw new NotFoundException(__('Invalid attachments block'));
		}
		$options = array('conditions' => array('AttachmentsBlock.' . $this->AttachmentsBlock->primaryKey => $id));
		$this->set('attachmentsBlock', $this->AttachmentsBlock->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AttachmentsBlock->create();
			if ($this->AttachmentsBlock->save($this->request->data)) {
				$this->Session->setFlash(__('The attachments block has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachments block could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->AttachmentsBlock->exists($id)) {
			throw new NotFoundException(__('Invalid attachments block'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AttachmentsBlock->save($this->request->data)) {
				$this->Session->setFlash(__('The attachments block has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachments block could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AttachmentsBlock.' . $this->AttachmentsBlock->primaryKey => $id));
			$this->request->data = $this->AttachmentsBlock->find('first', $options);
		}
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
		$this->AttachmentsBlock->id = $id;
		if (!$this->AttachmentsBlock->exists()) {
			throw new NotFoundException(__('Invalid attachments block'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AttachmentsBlock->delete()) {
			$this->Session->setFlash(__('Attachments block deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attachments block was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
