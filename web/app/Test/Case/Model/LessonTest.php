<?php
App::uses('Lesson', 'Model');

/**
 * Lesson Test Case
 *
 */
class LessonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lesson',
		'app.course',
		'app.user',
		'app.attachment',
		'app.type',
		'app.timestamp',
		'app.block',
		'app.attachments_block'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Lesson = ClassRegistry::init('Lesson');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lesson);

		parent::tearDown();
	}

}
