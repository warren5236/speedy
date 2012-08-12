<?php
class Speedy_View_Helper_urlDefault extends Zend_View_Helper_Abstract
{
	private $_view;
	
	public function setView(Zend_View_Interface $view) {
		$this->_view = $view;
	}
	
	public function urlDefault($array){
		return $this->_view->url($array,'default', true);
	}
}