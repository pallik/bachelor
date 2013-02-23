<?php
App::uses('AppController', 'Controller');
/**
 * Lessons Controller
 *
 * @property Lesson $Lesson
 */
class LessonsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Lesson->recursive = 0;
		$this->set('lessons', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Lesson->exists($id)) {
			throw new NotFoundException(__('Invalid lesson'));
		}
		$options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
		$this->set('lesson', $this->Lesson->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Lesson->create();
			if ($this->Lesson->save($this->request->data)) {
				$this->Session->setFlash(__('The lesson has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lesson could not be saved. Please, try again.'));
			}
		}
		$courses = $this->Lesson->Course->find('list');
		$this->set(compact('courses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Lesson->exists($id)) {
			throw new NotFoundException(__('Invalid lesson'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lesson->save($this->request->data)) {
				$this->Session->setFlash(__('The lesson has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lesson could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
			$this->request->data = $this->Lesson->find('first', $options);
		}
		$courses = $this->Lesson->Course->find('list');
		$this->set(compact('courses'));
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
		$this->Lesson->id = $id;
		if (!$this->Lesson->exists()) {
			throw new NotFoundException(__('Invalid lesson'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lesson->delete()) {
			$this->Session->setFlash(__('Lesson deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lesson was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Lesson->recursive = 0;
		$this->set('lessons', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Lesson->exists($id)) {
			throw new NotFoundException(__('Invalid lesson'));
		}
		$options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
		$this->set('lesson', $this->Lesson->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Lesson->create();
			if ($this->Lesson->save($this->request->data)) {
				$this->Session->setFlash(__('The lesson has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lesson could not be saved. Please, try again.'));
			}
		}
		$courses = $this->Lesson->Course->find('list');
		$this->set(compact('courses'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Lesson->exists($id)) {
			throw new NotFoundException(__('Invalid lesson'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lesson->save($this->request->data)) {
				$this->Session->setFlash(__('The lesson has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lesson could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
			$this->request->data = $this->Lesson->find('first', $options);
		}
		$courses = $this->Lesson->Course->find('list');
		$this->set(compact('courses'));
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
		$this->Lesson->id = $id;
		if (!$this->Lesson->exists()) {
			throw new NotFoundException(__('Invalid lesson'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lesson->delete()) {
			$this->Session->setFlash(__('Lesson deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lesson was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
