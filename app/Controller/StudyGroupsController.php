<?php
App::uses('AppController', 'Controller');
/**
 * StudyGroups Controller
 *
 * @property StudyGroup $StudyGroup
 * @property PaginatorComponent $Paginator
 */
class StudyGroupsController extends AppController {

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
		$this->StudyGroup->recursive = 0;
		$this->set('studyGroups', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->StudyGroup->create();
			if ($this->StudyGroup->save($this->request->data)) {
				$this->Session->setFlash(__('Die Studiengruppe wurde gespeichert.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Die Studiengruppe konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
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
		if (!$this->StudyGroup->exists($id)) {
			throw new NotFoundException(__('Die Studiengruppe konnte nicht gefunden werden'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->StudyGroup->save($this->request->data)) {
				$this->Session->setFlash(__('Die Studiengruppe wurde gespeichert.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Die Studiengruppe konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		} else {
			$options = array('conditions' => array('StudyGroup.' . $this->StudyGroup->primaryKey => $id));
			$this->request->data = $this->StudyGroup->find('first', $options);
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
		$this->StudyGroup->id = $id;
		if (!$this->StudyGroup->exists()) {
			throw new NotFoundException(__('Die Studiengruppe konnte nicht gefunden werden.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->StudyGroup->delete()) {
			$this->Session->setFlash(__('Die Studiengruppe wurde gelöscht.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
		} else {
			$this->Session->setFlash(__('Die Studiengruppe konnte nicht gelöscht werden. Bitte versuchen Sie es erneut.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
