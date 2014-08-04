<?php
App::uses('AppController', 'Controller');
/**
 * Keywords Controller
 *
 * @property Keyword $Keyword
 * @property PaginatorComponent $Paginator
 */
class KeywordsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index($conceptMapId) {

		// Prüfung, ob gesuchte Concept-Map existiert
		if(!$this->Keyword->ConceptMap->exists($conceptMapId)) {
			throw new NotFoundException(__('Die angegebene Concept-Map existiert nicht.'));
			
		}

		// Concept-Map Namen ziehen
		$conceptMapName = $this->Keyword->ConceptMap->getNameOfConceptMap($conceptMapId);

		// Find eingrenzen, um lediglich die Keywords zu finden, die zu einer Concept-Map gehören
		$this->Paginator->settings = array(
			'conditions' => array(
				'Keyword.concept_map_id' => $conceptMapId
				),
			'recursive' => 0
			);

		// Keywords ziehen
		$keywords = $this->Paginator->paginate();

		$this->set(compact('keywords', 'conceptMapName'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Keyword->create();
			if ($this->Keyword->save($this->request->data)) {
				$this->Session->setFlash(__('keyword wurde gespeichert.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('keyword konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		}
		$conceptMaps = $this->Keyword->ConceptMap->find('list');
		$this->set(compact('conceptMaps'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Keyword->exists($id)) {
			throw new NotFoundException(__('keyword konnte nicht gefunden werden'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Keyword->save($this->request->data)) {
				$this->Session->setFlash(__('keyword wurde gespeichert.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('keyword konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		} else {
			$options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
			$this->request->data = $this->Keyword->find('first', $options);
		}
		$conceptMaps = $this->Keyword->ConceptMap->find('list');
		$this->set(compact('conceptMaps'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Keyword->id = $id;
		if (!$this->Keyword->exists()) {
			throw new NotFoundException(__('keyword konnte nicht gefunden werden.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Keyword->delete()) {
			$this->Session->setFlash(__('The keyword wurde gelöscht.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
		} else {
			$this->Session->setFlash(__('keyword konnte nicht gelöscht werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
