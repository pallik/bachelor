<?php
App::uses('AppController', 'Controller');
/**
 * Lessons Controller
 *
 * @property Lesson $Lesson
 */
class LessonsController extends AppController {

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$courseIds = $this->Lesson->Course->find('list', array(
			'conditions' => array(
				'Course.user_id' => $this->Auth->User('id')
			)
		));

		$courseIds = array_keys($courseIds);

		$this->paginate = array(
			'conditions' => array(
				'Lesson.course_id' => $courseIds
			)
		);
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

//		$courseIds = $this->Lesson->Course->find('list', array(
//			'conditions' => array(
//				'Course.user_id' => $this->Auth->User('id')
//			)
//		));
//		$courseIds = array_keys($courseIds);
//
//		if (!in_array($id, $courseIds)) {
//			$this->redirect(array('action' => 'index'));
//		}



		$lesson = $data = $this->Lesson->find('first', array(
			'conditions' => array(
				'Lesson.id' => $id
			),
			'contain' => array(
				'Block' => array(
					'Timestamp' => array(
						'Attachment' => array(
							'Type'
						)
					)
				),
				'Course',
				'Attachment'
			)
		));

		$this->set(compact('lesson', 'data'));
		$this->set('_serialize', array('data'));
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
				if ($this->saveMasterVideoBlock($this->Lesson->getInsertID())) {
					$this->Session->setFlash(__('The lesson has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Can\'t save video block.'));
				}
			} else {
				$this->Session->setFlash(__('The lesson could not be saved. Please, try again.'));
			}
		}
		$courses = $this->Lesson->Course->find('list');
		$videoId = $this->Lesson->Attachment->Type->field('id', array('Type.name' => 'video'));
		$attachments = $this->Lesson->Attachment->find('list', array(
			'conditions' => array(
				'Attachment.type_id' => $videoId,
				'Attachment.status' => true
			)
		));
		$this->set(compact('courses', 'attachments'));
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
		$videoId = $this->Lesson->Attachment->Type->field('id', array('Type.name' => 'video'));
		$attachments = $this->Lesson->Attachment->find('list', array(
			'conditions' => array(
				'Attachment.type_id' => $videoId,
				'Attachment.status' => true
			)
		));
		$this->set(compact('courses', 'attachments'));
	}


	/**
	 * @param $id
	 * @throws NotFoundException
	 */
	public function admin_editor($id) {
		if (!$this->Lesson->exists($id)) {
			throw new NotFoundException(__('Invalid lesson'));
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
	 * View lesson for students
	 *
	 * @param $id
	 */
	public function view($id) {
		if (!$this->Lesson->exists($id)) {
			$this->redirect(array('admin' => true, 'action' => 'index'));
		}

		$lesson = $this->Lesson->find('first', array(
			'conditions' => array(
				'Lesson.id' => $id
			),
			'contain' => array(
				'Block' => array(
					'Timestamp' => array(
						'Attachment' => array(
							'Type'
						)
					)
				),
				'Course',
				'Attachment'
			)
		));

		if (!$lesson['Lesson']['status']) {
			$this->redirect(array('admin' => true, 'action' => 'index'));
		}

		$title_for_layout = $lesson['Lesson']['name'];
		$this->set(compact('lesson', 'title_for_layout'));
		$this->set('_serialize', array('lesson'));
	}

	/**
	 * donwloading file
	 */
	public function download() {

//		$this->viewClass = 'Media';
//		$this->set(array(
//			'id' => 'string.jpg',
//			'name' => 'nieco',
//			'extension' => 'jpg',
//			'path' => 'uploads'.DS,
//			'download' => true,
//		));

		$this->response->file('uploads' . DS . 'string.jpg', array(
//			'download' => true,
//			'name' => 'struna.jpg'
		));
		return $this->response;

//		http://www.tuxradar.com/content/cakephp-tutorial-build-file-sharing-application

	}

	/**
	 * @param $lessonId
	 * @return mixed
	 */
	private function saveMasterVideoBlock($lessonId) {
		$blockData = array(
			'lesson_id' => $lessonId,
			'target' => 'masterVideo',
//			'style' => 'top: 10px; left: 10px; width: 400px; height: 400px;',
			'status' => true,
			'master' => true
		);

		$this->Lesson->Block->create();
		return $this->Lesson->Block->save($blockData);
	}
}
