<?php
App::uses('AppModel', 'Model');
/**
 * Evaluation Model
 *
 * @property ConceptMap $ConceptMap
 * @property StudyGroup $StudyGroup
 */
class Evaluation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'concept_map_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'evaluated' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ConceptMap' => array(
			'className' => 'ConceptMap',
			'foreignKey' => 'concept_map_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'StudyGroup' => array(
			'className' => 'StudyGroup',
			'foreignKey' => 'study_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
