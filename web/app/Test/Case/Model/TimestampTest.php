<?php
App::uses('Timestamp', 'Model');

/**
 * Timestamp Test Case
 *
 */
class TimestampTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.timestamp',
		'app.attachment',
		'app.user',
		'app.course',
		'app.lesson',
		'app.block',
		'app.attachments_block',
		'app.type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Timestamp = ClassRegistry::init('Timestamp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Timestamp);

		parent::tearDown();
	}

}
