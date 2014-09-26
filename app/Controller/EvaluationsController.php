<?php
App::uses('AppController', 'Controller');
/**
 * Evaluations Controller
 *
 * @property Evaluation $Evaluation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EvaluationsController extends AppController {

	public function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow(array('add'));
        $this->Security->unlockedActions = array('add');
    }

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index($concept_map_id) {
		$this->Evaluation->recursive = 0;
		$conceptMap = $this->Evaluation->ConceptMap->findById($concept_map_id);
		$this->set('evaluations', $this->Paginator->paginate('Evaluation', array('Evaluation.concept_map_id' => $concept_map_id)));
		$this->set('conceptMap', $conceptMap);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Evaluation->exists($id)) {
			throw new NotFoundException(__('Das Resultat konnte nicht gefunden werden.'));
		}

		// Layout für ConceptMap setzen
		$this->layout = 'conceptMapCreator';

		$options = array('conditions' => array('Evaluation.' . $this->Evaluation->primaryKey => $id));
		$this->set('evaluation', $this->Evaluation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Evaluation->create();
			$this->Evaluation->save($this->request->data);
			return $this->redirect(array('controller' => 'pages', 'action' => 'thanks'));
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
		$this->Evaluation->id = $id;
		if (!$this->Evaluation->exists()) {
			throw new NotFoundException(__('Das Resultat konnte nicht gefunden werden.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evaluation->delete()) {
			$this->Session->setFlash(__('Das Resultat wurde gelöscht.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
		} else {
			$this->Session->setFlash(__('Das Resultat konnte nicht gelöscht werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
