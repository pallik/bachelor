<?php
App::uses('AppController', 'Controller');
/**
 * Blocks Controller
 *
 * @property Block $Block
 */
class BlocksController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Block->recursive = 0;
		$this->set('blocks', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Block->exists($id)) {
			throw new NotFoundException(__('Invalid block'));
		}
		$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
		$this->set('block', $this->Block->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Block->create();
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__('The block has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The block could not be saved. Please, try again.'));
			}
		}
		$lessons = $this->Block->Lesson->find('list');
		$this->set(compact('lessons'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Block->exists($id)) {
			throw new NotFoundException(__('Invalid block'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__('The block has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The block could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
			$this->request->data = $this->Block->find('first', $options);
		}
		$lessons = $this->Block->Lesson->find('list');
		$this->set(compact('lessons'));
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
		$this->Block->id = $id;
		if (!$this->Block->exists()) {
			throw new NotFoundException(__('Invalid block'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Block->delete()) {
			$this->Session->setFlash(__('Block deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Block was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


	/**
	 * saves all blocks via ajax - editor
	 *
	 * @return string
	 */
	public function admin_saveAll() {
		$this->redirectIfNotAjax();
		$result['success'] = true;

		foreach ($this->request->data as $i => $block) {
			$this->Block->create();
			$result['success'] = $result['success'] && $this->Block->save($block);
			$this->request->data[$i]['insertedId'] = $this->Block->getInsertID();
		}


//		$result['success'] = $this->Block->saveMany($this->request->data);
//		$result['ids'] = $this->Block->insertedIds;
		$result['blocks'] = $this->request->data;

		$this->autoRender = false;
		return json_encode($result);
	}
}
