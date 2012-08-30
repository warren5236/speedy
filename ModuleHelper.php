<?php
class Speedy_ModuleHelper{
	public static function getAllModuleDirectories($childDir){
		$returnVal = array();
		
		foreach(Speedy_ModuleHelper::getAllModules() as $module){
			$path = APPLICATION_PATH . '/modules/' . $module . '/' . $childDir;
			if(is_dir($path)){
				$returnVal[] = $path;
			}
		}
		
		return $returnVal;
	}
	
	public static function getAllModuleFiles($childFile){
		$returnVal = array();
		
		foreach(Speedy_ModuleHelper::getAllModules() as $module){
			$path = APPLICATION_PATH . '/modules/' . $module . '/' . $childFile;
			if(is_file($path)){
				$returnVal[] = $path;
			}
		}
		
		return $returnVal;
	}
	
	protected static $_allModules = null;
	
	public static function getAllModules(){
		
		if(self::$_allModules == null){
			self::$_allModules = array();
			$path = APPLICATION_PATH . '/modules/';
			if($handle = opendir($path)){
				while(($file = readdir($handle)) !== false){
					if($file == '.' or $file == '..'){
						continue;
					}
					
					$fullPath = $path . $file;
					if(is_dir($fullPath)){
						self::$_allModules[] = $file;
					}
				}
			}
		}
		
		
		return self::$_allModules;
	}
}