<?php

class User_Model_User extends Base_Model
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "user";		
	}	
	
	public function insert($obj)
	{
		$id = $this->isExistUsername($obj->username);
		
		if($id)
			throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID, "Tên tài khoản đã tồn tại");
		
		parent::_insert($obj);
	}
	
	private function isExistUsername($username)
	{
		$sql = "SELECT
					id
				FROM
					user
				WHERE
					username = '$username'";
		
		$id = $this->_db->fetchOne($sql);
		
		return $id;
	}
}