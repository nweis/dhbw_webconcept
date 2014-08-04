<?php
App::uses('Test', 'Model');

/**
 * Test Test Case
 *
 */
class TestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.test',
		'app.user',
		'app.group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Test = ClassRegistry::init('Test');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Test);

		parent::tearDown();
	}

}
