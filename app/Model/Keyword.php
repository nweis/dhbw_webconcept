<?php
App::uses('AppModel', 'Model');
/**
 * Keyword Model
 *
 * @property ConceptMap $ConceptMap
 */
class Keyword extends AppModel {

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
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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
		)
	);
}
