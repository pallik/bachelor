<?php
/**
 * TimestampFixture
 *
 */
class TimestampFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'attachment_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'start' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'end' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_attachments_lessons_attachments_idx' => array('column' => 'attachment_id', 'unique' => 0),
			'fk_attachments_blocks_blocks_idx' => array('column' => 'block_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'attachment_id' => 1,
			'block_id' => 1,
			'start' => 1,
			'end' => 1
		),
	);

}
