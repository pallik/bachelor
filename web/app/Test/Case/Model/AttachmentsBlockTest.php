<?php
App::uses('AttachmentsBlock', 'Model');

/**
 * AttachmentsBlock Test Case
 *
 */
class AttachmentsBlockTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.attachments_block',
		'app.attachment',
		'app.user',
		'app.course',
		'app.lesson',
		'app.block',
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
		$this->AttachmentsBlock = ClassRegistry::init('AttachmentsBlock');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AttachmentsBlock);

		parent::tearDown();
	}

}
