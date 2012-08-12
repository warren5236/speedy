<?php
class Speedy_Views_Helpers_CSS extends Zend_View_Helper_Abstract
{
	protected static $_CSS = null;
	public function CSS(){
		// check to see if the CSS class has been created
		if(self::$_CSS == null){
			self::$_CSS = new Speedy_Helpers_Css();
		}
		
		return self::$_CSS;
	}
}