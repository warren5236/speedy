<?php
class Speedy_Plugins_UseGenericController extends Zend_Controller_Plugin_Abstract{
	public function preDispatch(Zend_Controller_Request_Abstract $request){
		$dispatcher = Zend_Controller_Front::getInstance()->getDispatcher();
		if (!$dispatcher->isDispatchable($request)) {
			echo 'find';
		}
	}
	
}
