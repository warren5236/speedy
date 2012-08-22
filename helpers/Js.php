<?php
class Speedy_Helpers_Js extends Speedy_Helpers_StaticFiles{
	protected $_extension = 'js';
	
	public function __construct(){
		$this->_outputDirectory = dirname(APPLICATION_PATH) . '/public/scripts/';
	}
	
	public function getGoogleJquery($version = '1'){
		return $this->scriptTag('http://ajax.googleapis.com/ajax/libs/jquery/' . $version . '/jquery.min.js');
	}
	
	public function getGoogleJqueryUI($version = '1'){
		return $this->scriptTag('https://ajax.googleapis.com/ajax/libs/jqueryui/' . $version . '/jquery-ui.min.js');
	}
	
	public function scriptTag($src){
		return '<script type="text/javascript" src="' . $src . '"></script>';
	}
	
	public function getScript($section){
		// check to see if this section exists
		if(!array_key_exists($section, $this->_files)){
			// return blank
			return '';
		}

		// build the files and get the name
		$filename = $this->_buildFiles($section);

		// return the script tag
		return $this->scriptTag('/scripts/' . $filename);
	}
}