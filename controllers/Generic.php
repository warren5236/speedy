<?php
	class Speedy_Controllers_Generic extends Zend_Controller_Action
	{
		public function init(){
			// get the parameters
			$params = $this->getRequest()->getParams();
			
			$this->view->controller = $params['controller'];
			$this->view->action = $params['action'];
			$this->view->currentUser = Application_Model_User::getCurrentUser();
			$this->view->isLoggedIn = Application_Model_User::isLoggedIn();
		}
		
		public function getModelName(){
			$className = get_class($this);
			
			$className = str_replace('Controller', '', $className);
			$classParts = explode('_', $className);
			
			$first = array_shift($classParts);
			array_unshift($classParts, 'Model');
			array_unshift($classParts, $first);
			
			$className = implode('_', $classParts);
			
			return $className;
		}
		
		public function indexAction(){
			
			$className = $this->getModelName();
			// get all the objects
			$this->view->items = $className::fetchAll();
		}
	}