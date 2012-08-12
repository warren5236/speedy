<?php 
abstract class Speedy_Model_Generic{
	
	// the variables that are tracked in 
	protected $_variables = array();
	
	public static abstract function find($id);
	
	public function __call($name, $arguments){
		
		// get the first three letters
		$action = substr($name,0,3);
		
		// get the variable
		$variable = strtolower(substr($name,3,1)) . substr($name,4);

		// check to see if this is a variable
		if(!array_key_exists($variable, $this->_variables)){
			// we're trying to access something we should have
			throw new Exception('Unknown variable: ' . $variable);
		}
		
		if($action == 'get'){
			// return the value
			return $this->_variables[$variable];
		} else if ($action == 'set'){
			// save the value
			$this->_variables[$variable] = $arguments[0];
			
			// return this so methods can be chained
			return $this;
		}
	}
	
	public function __construct($options){
		$this->setOptions($options);
	}
	
	public function getClassName(){
		$class = explode('_', get_class($this));
		return strtolower($class[count($class)-1]);
	}
	
	public static function getTableName($className){
		// split based on the _
		$parts = explode('_', $className);
		
		// get the last part
		$tableName = $parts[count($parts)-1];
		
		// return the lowercase version of the table name
		return strtolower($tableName);
	}
	
	public static function fetchAllModel($className, $where=null, $sort=null,$limit=null, $page=null){
		// get the table name
		$tableName = Speedy_Model_Generic::getTableName($className);

		// get a connection to the database
		$db = Zend_Db_Table::getDefaultAdapter();
		
		// create the query
		$select = $db->select()->from($tableName, array('id'));
		
		// perform the query
		$items = $db->fetchAll($select);
		
		// the results
		$returnVal = array();
		
		// loop through the results
		foreach($items as $item){
			$returnVal[] = Speedy_Model_Generic::findModel($item['id'], $className);
		}
		
		return $returnVal;
	}
	
	public static function findModel($id, $modelName){
		// get the table name
		$tableName = Speedy_Model_Generic::getTableName($modelName);
		
		// perform the search 
		// get a connection to the database
		$db = Zend_Db_Table::getDefaultAdapter();
		
		// create the query
		$select = $db->select()->from($tableName)->where('id = ' . $id);
		
		// perform the query
		$items = $db->fetchAll($select);
		
		// check to see if there are results
		if(count($items) == 0){
			return null;
		}
		
		// create a new model
		return new $modelName($items[0]);
	}
	
	public function setOptions($options){
		// loop through all the options
		foreach($options as $key => $value){
			$this->_variables[$key] = $value;
		}
	}
	
	
	public function getViewArray(){
		$returnVal = array(
			'controller'=>$this->getClassName(),
			'action'=>'view',
			'id'=>$this->_variables['id']
		);
		return $returnVal;
	}
}