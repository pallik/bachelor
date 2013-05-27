<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 * @property AuthComponent $Auth
 * @property AclComponent $Acl
 * @property CookieComponent $Cookie
 * @property EmailComponent $Email
 * @property RequestHandlerComponent $RequestHandler
 * @property SecurityComponent $Security
 * @property SessionComponent $Session
 */
class AppController extends Controller {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'RequestHandler',
		'Auth' => array(
			'loginRedirect' => array('admin' => true, 'controller' => 'courses', 'action' => 'index'),
			'logoutRedirect' => array('admin' => true, 'controller' => 'users', 'action' => 'login')
		)
	);

	/**
	 * Helpers
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Text',
		'Js',
		'Time',
		'Layout',
//		'Paginator'
	);

	/**
	 * Using Twig template system
	 *
	 * @var string
	 */
	public $viewClass = 'TwigView.Twig';

	/**
	 * before filter
 	 */
	public function beforeFilter() {
		parent::beforeFilter();

		if (!isset($this->params['admin'])) {
			$this->Auth->allow();
		}

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		$this->set('authUser', $this->Auth->user());
	}

	/**
	 * redirects if not ajax call
	 */
	public function redirectIfNotAjax() {
		if (!$this->request->is('ajax')) {
			$this->redirect($this->Auth->loginRedirect);
		}
	}


	/**
	 * @param $modelAlias
	 * @param $id
	 */
	public function redirectIfNotOwn($modelAlias, $id) {
		$count = $this->$modelAlias->find('count', array(
			'conditions' => array(
				$modelAlias . '.user_id' => $this->Auth->user('id'),
				$modelAlias . '.id' => $id
		)));

		if ($count == 0) {
			$this->redirect($this->Auth->loginRedirect);
		}
	}

}
