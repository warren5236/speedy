<?php
	class Speedy_Controllers_Generic extends Zend_Controller_Action
	{
		public function init(){
			// get the parameters
			$params = $this->getRequest()->getParams();
			
			$this->view->controller = $params['controller'];
			$this->view->action = $params['action'];
			$this->view->module = $params['module'];
			$this->view->params = $param;
			$this->view->currentUser = Default_Model_User::getCurrentUser();
			$this->view->isLoggedIn = Default_Model_User::isLoggedIn();
			
			$modulesToCheck = array('default');
			
			if($params['module'] != 'default'){
				$modulesToCheck[] = $params['module'];
			}
			
			$JS = $this->view->Js();
			$CSS = $this->view->Css();
			
			foreach($modulesToCheck as $module){
				$path = APPLICATION_PATH . '/modules/' . $module . '/scripts/';
				if(is_dir($path)){
					$JS->prependFolder($module, $path);
				}
				
				$path = APPLICATION_PATH . '/modules/' . $module . '/css/';
				if(is_dir($path)){
					$CSS->prependFolder($module, $path);
				}
			}
		}
		
		public function getModelName(){
			$params = $this->getRequest()->getParams();
			$className = ucwords($params['module']) . '_Model_' . ucwords($params['controller']);
			
			return $className;
		}
		
		public function indexAction(){
			
			$className = $this->getModelName();
			// get all the objects
			$this->view->items = $className::fetchAll();
		}
	}