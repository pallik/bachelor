<?php
App::uses('Type', 'Model');

/**
 * Type Test Case
 *
 */
class TypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.type',
		'app.attachment',
		'app.user',
		'app.course',
		'app.lesson',
		'app.block',
		'app.timestamp',
		'app.attachments_block'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Type = ClassRegistry::init('Type');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Type);

		parent::tearDown();
	}

}
