<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('login'));
	}

	/**
	 * login method
	 */

	public function login() {
		$this->autoRender = false;

		if ($this->request->is('post')) {

			if ($this->Auth->login()) {
				$this->User->id = $this->Auth->user('id'); // Richtigen User anvisieren
				$this->User->saveField('lastlogin', date(DATE_ATOM)); // Login-Zeit speichern
				$this->Session->setFlash(__('Sie sind nun eingeloggt.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);

				return $this->redirect('/'); // Weiterleiten zu Default-Login-Seite

			} else {
				$this->Session->setFlash(__('Die Kombination von Benutzername und Passwort konnte nicht gefunden werden.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
				
				return $this->redirect('/'); // Weiterleiten zu Default-Login-Seite
			}
				
		}

	}
	
	
	/**
	 * logout method
	 */
	public function logout() {

		$this->Session->setFlash(__('Sie sind nun ausgeloggt.'), 'alert', array(
			'plugin' => 'BoostCake',
			'class' => 'alert-success'
			)
		);

		return $this->redirect($this->Auth->logout());
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
	
	/**
	 * 
	 * Method changes the users password
	 */
	public function changePassword() {
		if($this->request->is('post')) {
			$data = $this->request->data;
			
			// Call method to change password in user model
			$result = $this->User->changePassword($data, $this->getUid());
			
			if($result === true) {
				
				// Clear request data
				$this->request->data['User']['password'] = '';
				$this->request->data['User']['old_password'] = '';
				$this->request->data['User']['password_repeat'] = '';
				
				$this->Session->setFlash(__('Ihr Passwort wurde geändert.'), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
					)
				);
								
			}else{
				$this->Session->setFlash($result, 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		}
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		// User soll angelegt werden
		if ($this->request->is('post')) {
			
			$data = $this->request->data;
			
			$userDataValid = $this->User->userDataValid($data, false);

			if($userDataValid === true) {
				$this->User->create();
				if ($this->User->save($data)) {
					$this->Session->setFlash(__('Der Benutzer wurde erfolgreich angelegt.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
						)
					);
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Der Benutzer konnte nicht angelegt werden. Bitte versuchen Sie es erneut.'), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
						)
					);
				}
									
			}else{
				$this->Session->setFlash($userDataValid, 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}
		}
			
		
		$groups = $this->User->Group->find('list');
		
		$this->set(compact('groups'));
	}
	

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Unbekannter Benutzer'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			$userDataValid = $this->User->userDataValid($data, true);		


			if($userDataValid === true) {

				$saveData = true;

				if($data['User']['password'] == '') {
					unset($data['User']['password']);
					unset($data['User']['password_repeat']);
				}else{
					$checkPassword = $this->User->checkPassword($data);

					if(!($checkPassword === true)) {
						$this->Session->setFlash($checkPassword, 'alert', array(
							'plugin' => 'BoostCake',
							'class' => 'alert-danger'
							)
						);

						$saveData = false;
					}
				}

				if($saveData) {
					if ($this->User->save($data)) {
						$this->Session->setFlash(__('Die Änderungen wurden gespeichert.'), 'alert', array(
							'plugin' => 'BoostCake',
							'class' => 'alert-success'
							)
						);
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('Die Änderungen konnten nicht gespeichert werden. Bitte versuchen Sie es erneut.'), 'alert', array(
							'plugin' => 'BoostCake',
							'class' => 'alert-danger'
							)
						);
					}
				}

			}else{
				$this->Session->setFlash($userDataValid, 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					)
				);
			}


		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Unbekannter Benutzer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('Der Benutzer wurde gelöscht.'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
				)
			);
		} else {
			$this->Session->setFlash(__('Der Benutzer konnte nicht gelöscht werden. Bitte versuchen Sie es erneut'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-danger'
				)
			);
		}
		return $this->redirect(array('action' => 'index'));
	}}
