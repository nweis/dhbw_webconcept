<?php
/**
 * EvaluationFixture
 *
 */
class EvaluationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'concept_map_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'study_group_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'content' => array('type' => 'binary', 'null' => false, 'default' => null),
		'evaluated' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_concept_maps_idx' => array('column' => 'concept_map_id', 'unique' => 0),
			'fk_study_groups_idx' => array('column' => 'study_group_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'concept_map_id' => 1,
			'study_group_id' => 1,
			'content' => 'Lorem ipsum dolor sit amet',
			'evaluated' => 1,
			'created' => '2014-09-26 13:28:37',
			'modified' => '2014-09-26 13:28:37'
		),
	);

}
