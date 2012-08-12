<?php
class Speedy_Model_User extends Speedy_Model_Generic{
	
	protected static $_currentUser = null;
	
	protected static function _getSession(){
		return new Zend_Session_Namespace('user');
	}
	
	public static function isLoggedIn(){
		$session = Speedy_Model_User::_getSession();
		
		if(!isset($session->userId)){
			return false;
		}
		
		return true;
	}
	
	public static function getCurrentUser(){
		// check to see if we've loaded the user
		if(Speedy_Model_User::$_currentUser == null){
			if(Speedy_Model_User::isLoggedIn()){
				$session = Speedy_Model_User::_getSession();
				Speedy_Model_User::$_currentUser = Speedy_Model_User::find($session->userId);
			} else {
				Speedy_Model_User::$_currentUser = new Application_Model_User(array('id'=>-1,'displayname'=>'Anonymous'));
			}
		}
		return Speedy_Model_User::$_currentUser;
	}
	
	public static function login($id){
		
	}
	
	public static function loginWithPassword($email,$password){
		
	}
	
	public static function hashPassword($password, $salt = ''){
		
	}
	
	public static function find($id){
		return Speedy_Model_Generic::findModel($id, 'Speedy_Model_User');
	}
}