<?php
	class Speedy_Controller_Generic extends Zend_Controller_Action
	{
		public function init(){
			// get the parameters
			$params = $this->getRequest()->getParams();
			
			$this->view->controller = $params['controller'];
			$this->view->action = $params['action'];
			$this->view->currentUser = Application_Model_User::getCurrentUser();
			$this->view->isLoggedIn = Application_Model_User::isLoggedIn();
		}
		
		public function getClassName(){
			return 'Speedy_Model_' . str_replace('Controller','', get_class($this));
		}
		
		public function indexAction(){
			// get all the objects
			$this->view->items = Speedy_Model_Generic::fetchAllModel($this->getClassName());
		}
	}