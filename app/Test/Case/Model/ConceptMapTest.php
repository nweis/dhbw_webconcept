<?php
App::uses('ConceptMap', 'Model');

/**
 * ConceptMap Test Case
 *
 */
class ConceptMapTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.concept_map',
		'app.keyword'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ConceptMap = ClassRegistry::init('ConceptMap');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ConceptMap);

		parent::tearDown();
	}

}
