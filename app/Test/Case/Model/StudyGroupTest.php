<?php
App::uses('StudyGroup', 'Model');

/**
 * StudyGroup Test Case
 *
 */
class StudyGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.study_group',
		'app.concept_map',
		'app.keyword',
		'app.concept_maps_study_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StudyGroup = ClassRegistry::init('StudyGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StudyGroup);

		parent::tearDown();
	}

}
