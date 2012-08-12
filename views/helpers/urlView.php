<?php
class Speedy_View_Helper_urlView extends Zend_View_Helper_Abstract
{
	private $_view;
	
	public function setView(Zend_View_Interface $view) {
		$this->_view = $view;
	}
	
	public function urlView($model){
		return $this->_view->url($model->getViewArray(),'default', true);
	}
}