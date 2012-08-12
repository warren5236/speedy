<?php
class Speedy_Helpers_StaticFiles {
	protected $_extension = null;
	
	/// The listing of the files that will be build up
	protected $_files = array();
	
	/// the output directory
	protected $_outputDirectory;
	
	protected function _buildFiles($section){
		// this is used to keep track of the last modify date we've found
		$lastModDate = '';
		
		// loop through the files
		foreach($this->_files[$section] as $file){
			// get the current mod time
			$modDate = filemtime($file);
			
			// check to see if this is greater than the last mod time
			if($lastModDate < $modDate){
				// save the current date
				$lastModDate = $modDate;
			}
		}
		
		// build the filename
		$filename = $section . '-' . $lastModDate . '.' . $this->_extension;
		
		// build the filepath
		$outputFilePath = $this->_outputDirectory . $filename;
		
		// check to see if this file already exists
		if(is_file($outputFilePath)){
			// it does so we don't need to build it
			return $filename;
		}
		
		// the contents of the master file
		$fileContents = '';
		
		// loop through the files again
		foreach($this->_files[$section] as $file){
			// add this on
			$fileContents .= file_get_contents($file);
		}
		
		// save the file
		file_put_contents($outputFilePath, $fileContents);
		
		return $filename;
	}
	
	protected function _getFolder($path){
		// return values
		$returnVals = array();
		
		// open the directory
		if(!($handle = opendir($path))){
			throw new Exception('Unable to open directory: ' . $path);
		}
		
		// loop through the entries
		while(false !== ($file = readdir($handle))){
			// build up the full path
			$fullpath = $path . '/' . $file;
			
			// check to see if this isn't a directory
			if(!is_dir($fullpath)){
				// add this value
				$returnVals[] = $fullpath;
			}
		}
		
		// sort the values
		sort($returnVals);
		
		// return the values
		return $returnVals;
	}
	
	public function prependFolder($section, $path){
		// get the items in the folder
		$newItems = $this->_getFolder($path);
		
		// check to see if this section is defined
		if(!array_key_exists($section, $this->_files)){
			// initilze this array
			$this->_files[$section] = array();
			
		}
		
		// add the new items
		$this->_files[$section] = array_merge($newItems, $this->_files[$section]);
	}
}