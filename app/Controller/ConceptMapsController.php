<?php
App::uses('AppController', 'Controller');
/**
 * ConceptMaps Controller
 *
 * @property ConceptMap $ConceptMap
 * @property PaginatorComponent $Paginator
 */
class ConceptMapsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * BeforeFilter wird ausgeführt, bevor andere Controller-Actions durchgeführt werden
 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('createConceptMap'));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ConceptMap->recursive = 1;
		$this->set('conceptMaps', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$data = $this->request->data;

			// Prüfung, ob der Name bereits existiert
			if(!$this->ConceptMap->checkIfNameExists($data['ConceptMap']['name'])) {
				$this->ConceptMap->create();
				if ($this->ConceptMap->save($this->request->data)) {
					$this->Session->setFlash(__('Die Concept-Map wurde gespeichert.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
						)
					);
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Die Concept-Map konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
						)
					);
				}
			}else{ // Falls die ConceptMap bereits existiert, gebe einen Fehler aus
				$this->Session->setFlash(__('Der Name einer Concept-Map muss eindeutig sein. Der gewählte Name existiert bereits.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		}

		$study_groups = $this->ConceptMap->StudyGroup->find('list');

		$this->set(compact('study_groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ConceptMap->exists($id)) {
			throw new NotFoundException(__('Die Concept-Map konnte nicht gefunden werden'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$data = $this->request->data;

			// Prüfung, ob der Name bereits existiert
			if(!$this->ConceptMap->checkIfNameExistsForGivenId($data['ConceptMap']['name'], $id)) {			

				if ($this->ConceptMap->save($data)) {
					$this->Session->setFlash(__('Die Concept-Map wurde gespeichert.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
						)
					);
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Die Concept-Map konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
						)
					);
				}
			}else{ // Falls die ConceptMap bereits existiert, gebe einen Fehler aus
				$this->Session->setFlash(__('Der Name einer Concept-Map muss eindeutig sein. Der gewählte Name existiert bereits.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		} else {
			$options = array('conditions' => array('ConceptMap.' . $this->ConceptMap->primaryKey => $id));
			$this->request->data = $this->ConceptMap->find('first', $options);
		}

		$study_groups = $this->ConceptMap->StudyGroup->find('list');
		$this->set(compact('study_groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ConceptMap->id = $id;
		if (!$this->ConceptMap->exists()) {
			throw new NotFoundException(__('Die Concept-Map konnte nicht gefunden werden.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConceptMap->delete()) {
			$this->Session->setFlash(__('Die Concept-Map wurde gelöscht.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
		} else {
			$this->Session->setFlash(__('Die Concept-Map konnte nicht gelöscht werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * Methode wird verwendet, um den Anwender auf den View zu leiten, der es ermöglicht eine ConceptMap grafisch zu erstellen
 * @param  String $conceptMapName Name einer existierenden Concept-Map
 * @return CakePHP view          View in dem der Anwender visuell eine ConceptMap erstellen kann
 */
	public function createConceptMap($conceptMapName) {

		// ConceptMap suchen anhand des eingegebenen Namens
		$conceptMap = $this->ConceptMap->findConceptMapByName($conceptMapName);

		// Layout für ConceptMap setzen
		$this->layout = 'conceptMapCreator';

		// Variablen an View übergeben
		$this->set('conceptMap', $conceptMap);
	}


}
