<?php
App::uses('AppController', 'Controller');

/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class UserController extends AppController {
	
	public $layout = "admin";
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('login', 'register'); 
		$this->loadModel("TPerson");
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function login() {
		App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
		// $sp = new SimplePasswordHasher();
		// echo (new SimplePasswordHasher)->hash('123456');exit;
		$this->checkLogin();		// check Login
		$errors = "";
		if ($this->request->isPost()) {
			$this->TPerson->set($this->request->data);
			if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FPassWord')))) {
				if ($this->Auth->login()) {
					return $this->redirect($this->Auth->redirect());
				} else {
					$this->Session->setFlash(__('用户名和密码错误。'), 'default', array('class' => 'error'));
				}
			}
		}
		
		$this->set('errors', $errors);
		$this->render('/Admin/User/index');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function register() {
		$errors = "";
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->TPerson->set($this->request->data);
			$this->TPerson->validator()->add('FMemberId', 'unique', array(
			    'rule' => 'isUnique',
			    'required' => 'create',
				'message' => "此账号已经存在了，请更换一个新的。"
			));
			if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FPassWord', 'FullName', 'FPhone', 'FMobileNumber', 'FEMail', 'FCity')))) {
				$this->TPerson->id = $this->uid;
				$query = $this->TPerson->addUser($this->request->data);
				if ($query) {
					$this->flashSuccess("注册成功，请登录。");
					return $this->redirect(array('action' => "login"));
				}
			}
		} else {
			//$this->request->data = $user;
		}
	
		$this->set('errors', $errors);
		$this->render('/Admin/User/register');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function loggout() {
		$this->redirect($this->Auth->logout());
	}


	
}