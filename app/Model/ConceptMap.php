<?php
App::uses('AppModel', 'Model');
/**
 * ConceptMap Model
 *
 * @property Keyword $Keyword
 */
class ConceptMap extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Keyword' => array(
			'className' => 'Keyword',
			'foreignKey' => 'concept_map_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	 * Methode wird verwendet, um den Namen einer bestimmten Concept-Map zu erhalten
	 * @param  int $id 	  id einer Concept-Map
	 * @return Array      Name und id einer Concept-Map
	 */
	public function getNameAndIdOfConceptMap($id) {

		// Prüfung, ob Concept-Map existiert
		if(!$this->exists($id)) {
			throw new NotFoundException(__('Die Concept-Map konnte nicht gefunden werden.'));
		}

		$conceptMapNameArray = $this->find('first', array(
			'conditions' => array(
					'ConceptMap.id' => $id
				),
			'fields' => array(
					'ConceptMap.id',
					'ConceptMap.name'
				),
			'recursive' => -1
			)
		);

		return $conceptMapNameArray;
	}


	public function findConceptMapByName($conceptMapName) {
		
		// Nach Concept-Map anhand des Namens suchen
		$conceptMap = $this->find('first', array(
			'conditions' => array(
				'ConceptMap.name' => $conceptMapName
				)
			)
		);

		if(empty($conceptMap)) {
			throw new NotFoundException(__('Die angegebene Concept-Map konnte nicht gefunden werden.'));
			
		}else{
			return $conceptMap;
		}
	}

}
