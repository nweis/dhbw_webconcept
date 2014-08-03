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
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ConceptMap->recursive = 0;
		$this->set('conceptMaps', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ConceptMap->exists($id)) {
			throw new NotFoundException(__('concept map konnte nicht gefunden werden.'));
		}
		$options = array('conditions' => array('ConceptMap.' . $this->ConceptMap->primaryKey => $id));
		$this->set('conceptMap', $this->ConceptMap->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ConceptMap->create();
			if ($this->ConceptMap->save($this->request->data)) {
				$this->Session->setFlash(__('concept map wurde gespeichert.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('concept map konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		}
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
			throw new NotFoundException(__('concept map konnte nicht gefunden werden'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ConceptMap->save($this->request->data)) {
				$this->Session->setFlash(__('concept map wurde gespeichert.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('concept map konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		} else {
			$options = array('conditions' => array('ConceptMap.' . $this->ConceptMap->primaryKey => $id));
			$this->request->data = $this->ConceptMap->find('first', $options);
		}
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
			throw new NotFoundException(__('concept map konnte nicht gefunden werden.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConceptMap->delete()) {
			$this->Session->setFlash(__('The concept map wurde gelöscht.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
		} else {
			$this->Session->setFlash(__('concept map konnte nicht gelöscht werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
