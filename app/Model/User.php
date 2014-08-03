<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property Allowance $Allowance
 */
class User extends AppModel {
	
	var $components = array('Security', 'Session', 'Auth');

	// Stellt sicher, dass Passwörter gehasht werden
    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }	
    
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create',
			),
		),
		'enabled' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
* Model functions
*/

	/**
	 * 
	 * Function is used to determine whether a username exists 
	 * @param String $username
	 */
	
	public function userNameExists($username) {
			$usernameExists = $this->find('first', array(
				'conditions' => array(
					'User.username' => $username),
				'fields' => array('User.id'),
				'recursive' => -1
				)
			);
			
			if(empty($usernameExists)) { // Prüfung, ob der Benutzername existiert
				return false;
			}else{
				return true;
			}
	}

	/**
	* Method checks password complexity this validation should rather be made on the attribute of the model
	*/
	public function passwordComplexeEnough($password) {
		if(!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/', $password)) {
			return false;
		}else{
			return true;
		}

	}


	public function userDataValid($data, $isUpdate) {

		if(!preg_match('/^[a-z0-9]{4,}$/i', $data['User']['username'])) {
				return __('Der Benutzername muss aus mindestens vier Zeichen und darf nur aus Zahlen und Buchstaben bestehen.');
		}else{
		
			if($this->userNameExists($data['User']['username'])) {
				if(!$isUpdate) {
					return __('Der Benutzername existiert bereits.');	
				}
			}else{
				// Check whether the validation process is within an update process
				if(!$isUpdate) {

					$checkPassword = $this->checkPassword($data);

					if(!($checkPassword === true)) {
						return $checkPassword;
					}
				}					
			}
		}

		return true;
	}
	
	public function changePassword($data, $user_id) {
		// Check whether old password is correct
		$checkOldPassword = $this->checkOldPassword($data, $user_id);
		
		if($checkOldPassword === true) {
			$checkPassword = $this->checkPassword($data);
			
			if($checkPassword === true) {
				$this->id = $user_id;
				
				if($this->saveField('password', $data['User']['password'])) {
					return true;	
				}else{
					return __('Ihr Passwort konnte nicht geändert werden. Bitte kontaktieren Sie den Betreiber.');
				}
				
				
			}else{
				return $checkPassword;
			}
		}else{
			return $checkOldPassword;
		}
			
	}
	
	/**
	 * Function checks whether the entered password matches the old userpassword
	 */
	public function checkOldPassword($data, $user_id) {
		$old_password_array = $this->find('first', array(
			'conditions' => array(
				'User.id' => $user_id
				),
			'fields' => array(
				'password'
				)
			)
		);
		
		$oldPassword = $old_password_array['User']['password'];
		$oldPasswordCheck = AuthComponent::password($data['User']['old_password']);

		if($oldPassword == $oldPasswordCheck) {
			return true;
		}else{
			return __('Das angegebene Passwort stimmt nicht mit Ihrem bisherigen Passwort überein.');
		}
	}

	/**
	 * Function checks whether the given $data-object ['User']['password'] and ['User']['password_repeat'] match and checks whether the password is complex enough
	 */
	public function checkPassword($data) {
		
		if($data['User']['password'] != $data['User']['password_repeat']) {
			return __('Die Passwörter stimmen nicht überein.');
		}else{
			// Check whether the password has reached a certain complexity
			if($this->passwordComplexeEnough($data['User']['password']) !== true) {
				return __('Das Passwort muss aus mindestens acht Zeichen bestehen, darf nur aus Zahlen und Buchstaben bestehen und mindestens eine Zahl und einen Buchstaben enthalten.');
			}
		}	

		return true;
	}

}