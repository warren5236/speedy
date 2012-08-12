<?php
class Speedy_Views_Helpers_JS extends Zend_View_Helper_Abstract
{
	protected static $_JS = null;
	public function JS(){
		// check to see if the CSS class has been created
		if(self::$_JS == null){
			self::$_JS = new Speedy_Helpers_Js();
		}
		
		return self::$_JS;
	}
}