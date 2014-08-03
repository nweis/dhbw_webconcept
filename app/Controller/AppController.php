<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	// Added to ensure boostcake support
	public $helpers = array(
		'Session',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'Security',
		'Auth' => array(
			'loginAction' => '/', // Definiert die Login-Aktion
			'logoutRedirect' => '/', // Wohin nach einem logout weitergeleitet wird
			'authorize' => 'Controller', // Welche Ebene die Auth-Component authentifiziert
			'authError' => 'Sie besitzen nicht genug Berechtigungen, um die Inhalte anzuzeigen.', // Fehlermeldung bei DeepLink
			'authenticate' => array(
				'Form' => array( // Auf welche Art
					// Sicherstellen, dass nur aktive sich einloggen dürfen
					'scope' => array('User.enabled' => 1)
					)
				),
			'flash' => array(
				'element' => 'alert',
				'key' => 'auth',
				'params' => array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				)
			)
		)
	);
	
	/**
	 * 
	 * Funktion überprüft, ob Benutzer eingeloggt ist, falls ja, wird er auf die Startseite umgeleitet.
	 */
	public function checkIfVistorIsLoggedIn() {
		// Verhindern, dass eingeloggte Benutzer erneut auf die Login-Seite gehen können
		if($this->Auth->user()) { // Wenn Login-Type-ID nicht leer ist, dann leite um auf Startseite
			$this->redirect('/');
		}
	}	

	// Globale before Filterfunktion wird verwendet um BlackholeCallback zu definieren
	public function beforeFilter() {
		$this->Security->blackHoleCallback = 'blackhole';
		
		// Sprache setzen
		if ($this->Session->check('Config.language')) {
            Configure::write('Config.language', $this->Session->read('Config.language'));
        }else{
        	Configure::write('Config.language', 'deu');
        	CakeSession::write('Config.language', 'deu');
       	}
	}

	public function blackhole($type) {
		//$this->Session->setFlash(__('ERROR: %s',$type));
		
		// TODO Change for production
		throw new ForbiddenException(__('Nicht autorisierter Zugriff. Durch Ihre Anfrage wurde eine Sicherheitsfunktion ausgelöst.'));
	}

	// Ausgelagerte isAuthorized()-Funktion - gesamte Rechteverwaltung findet in diesem Array statt!
	// 1 = Administrator
	// 2 = Anwender

	function isAuthorized() {
		$allowedActions = array (
		// Berechtigungen für Home
			'pages' => array(
				'display' => array(1, 2),
				'administration' => array(1),
				'terms' => array(0),
				'impressum' => array(0)
			),
			
		// Berechtigungen für user
			'users' => array(				
				'logout' => array(1, 2),
				'add' => array(1),
				'index' => array(1),
				'add' => array(1),
				'edit' => array(1),
				'delete' => array(1),
				'view' => array(1),
				'changePassword' => array(1, 2)
			),
			
		// Berechtigungen für ConceptMaps
			'conceptmaps' => array(
				'add' => array(1, 2),
				'index' => array(1, 2),
				'add' => array(1, 2),
				'edit' => array(1, 2),
				'delete' => array(1, 2),
				'view' => array(1, 2),
			),

			// Berechtigungen für Keywords
			'keywords' => array(
				'add' => array(1, 2),
				'index' => array(1, 2),
				'add' => array(1, 2),
				'edit' => array(1, 2),
				'delete' => array(1, 2),
				'view' => array(1, 2),
			)
	);
		// Wenn der Controller-Name ($this->name) in allowedActions vorkommt, dann...
		if(isset($allowedActions[strtolower($this->name)])) {

			// ...nimm die Controller-Actions in die $controllerActions
			$controllerActions = $allowedActions[strtolower($this->name)];

			// Wenn die Controller-Action in $controllerActions ist UND die Gruppen-ID des aktuellen Benutzers in dem Array
			if(isset($controllerActions[$this->action]) && in_array($this->Auth->user('group_id'), $controllerActions[$this->action])) {
				return true;
			}

		}
		return false;
	}

	public function getUid() {
		if($this->Session->read('Auth.User')) { // Wenn Benutzer eingeloggt ist
				$uid = $this->Session->read('Auth.User.id');
				return $uid; // Gibt die uid zurück
			}else{
				return 0; // Gibt 0 zurück, wenn der Benutzer nicht eingeloggt ist
			}
	}
	
	public function getGid() {
		if($this->Session->read('Auth.User')) { // Wenn Benutzer eingeloggt ist
				$gid = $this->Session->read('Auth.User.group_id');
				return $gid; // Gibt die uid zurück
			}else{
				return 0; // Gibt 0 zurück, wenn der Benutzer nicht eingeloggt ist
			}
	}
}
