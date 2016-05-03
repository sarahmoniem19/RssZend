<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'users';
	

	function insertUser($data){
		$row = $this->createRow();
        $row-> username = $data['username'];
        $row-> email = $data['email'];
        $row-> password = md5($data['password']);
        return $row->save();
	}
	// ------------------------------------------//
	function updateUser($id,$data){
		
	}
	// ------------------------------------------//
	function selectUser($id){
		return $this->fetchAll()->toArray();
	}

}

