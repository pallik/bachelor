<?php
App::uses('Course', 'Model');

/**
 * Course Test Case
 *
 */
class CourseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.course',
		'app.user',
		'app.attachment',
		'app.type',
		'app.timestamp',
		'app.block',
		'app.lesson',
		'app.attachments_block'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Course = ClassRegistry::init('Course');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Course);

		parent::tearDown();
	}

}
