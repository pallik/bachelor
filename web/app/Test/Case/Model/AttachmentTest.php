<?php
App::uses('Attachment', 'Model');

/**
 * Attachment Test Case
 *
 */
class AttachmentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.attachment',
		'app.user',
		'app.course',
		'app.lesson',
		'app.block',
		'app.attachments_block',
		'app.type',
		'app.timestamp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Attachment = ClassRegistry::init('Attachment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Attachment);

		parent::tearDown();
	}

}
