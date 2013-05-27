<?php
App::uses('AppController', 'Controller');
/**
 * Courses Controller
 *
 * @property Course $Course
 */
class CoursesController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Course->recursive = 0;
		$this->paginate = array(
			'conditions' => array(
				'Course.user_id' => $this->Auth->user('id')
			)
		);
		$this->set('courses', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Course->exists($id)) {
			throw new NotFoundException(__('Invalid course'));
		}

		$this->redirectIfNotOwn('Course', $id);

		$options = array('conditions' => array(
			'Course.' . $this->Course->primaryKey => $id,
			'Course.user_id' => $this->Auth->user('id')
		));
		$course = $this->Course->find('first', $options);
		$this->set(compact('course'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Course->create();
			$this->request->data['Course']['year'] = $this->request->data['Course']['year']['year'];
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('The course has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course could not be saved. Please, try again.'));
			}
		}
		$users = $this->Course->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Course->exists($id)) {
			throw new NotFoundException(__('Invalid course'));
		}
		$this->redirectIfNotOwn('Course', $id);

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Course']['year'] = $this->request->data['Course']['year']['year'];
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('The course has been saved'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The course could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array(
				'Course.' . $this->Course->primaryKey => $id,
				'Course.user_id' => $this->Auth->user('id')
			));
			$this->request->data = $this->Course->find('first', $options);
		}
		$users = $this->Course->User->find('list');
		$this->set(compact('users'));
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
		$this->Course->id = $id;
		if (!$this->Course->exists()) {
			throw new NotFoundException(__('Invalid course'));
		}

		$this->redirectIfNotOwn('Course', $id);

		$this->request->onlyAllow('post', 'delete');
		if ($this->Course->delete()) {
			$this->Session->setFlash(__('Course deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Course was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
