<?php
class Speedy_Featuretoggle{
	protected static $_instance = null;
	
	protected $_enableAll = false;
	protected $_settings = array();
	
	protected function enableAll(){
		$this->_enableAll = true;
	}
	
	public function setSettings($settings){
		$this->_settings = $settings;
	}
	
	protected function __construct(){
		
	}
	
	public static function getInstance(){
		if(self::$_instance == null){
			self::$_instance = new Speedy_Featuretoggle();
		}
		
		
		return self::$_instance;
	}
	
	public static function enabled($feature){
		if(self::$_instance == null){
			Speedy_Featuretoggle::getInstance();
		}
		
		
		return self::$_instance->isEnabled($feature);
	}
	
	public function isEnabled($feature){
		if($this->_enableAll){
			return true;
		}
		
		// check to see if this feature is defined
		if(!isset($this->_settings[$feature])){
			throw new Exception('Unknown feature: ' . $feature);
		}
		
		// save the settings so it's easier to check it
		$settings = $this->_settings[$feature];
		
		// check to see if this has site specific settings
		if(isset($settings['sites'][$_SERVER['APPLICATION_ENV']])){
			$settings = $settings['sites'][$_SERVER['APPLICATION_ENV']];
		}
		
		// check to see if there is a setting for the date
		if(isset($settings['startDate']) && gmdate('Y-m-d') >= $settings['startDate']){
			return true;
		}
		
		if(!isset($settings['enabled'])){
			return false;
		}
		
		return $settings['enabled'];
	}
}