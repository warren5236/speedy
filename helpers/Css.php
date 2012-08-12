<?php
class Speedy_Helpers_Css extends Speedy_Helpers_StaticFiles{
	protected $_extension = 'css';
	
	public function __construct(){
		$this->_outputDirectory = dirname(APPLICATION_PATH) . '/public/css/';
	}
	
	public function getLink($section){
		// check to see if this section exists
		if(!array_key_exists($section, $this->_files)){
			// return blank
			return '';
		}
		
		// build the files and get the name
		$filename = $this->_buildFiles($section);
		
		return '<link rel="stylesheet" type="text/css" href="/css/' . $filename .'">';
	}
	
	
}