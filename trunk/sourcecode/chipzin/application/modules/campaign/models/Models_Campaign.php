<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Campaign.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Campaign extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_campaign";	
	}
	public function getbattles($id)
	{
		$sql="
			SELECT 
				*
			FROM
				c_battle
			WHERE Campaign=$id
		";
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}	
	public function getAllbattle()
	{
		$sql="
			SELECT 
				* 
			FROM
				c_battle			
		";
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	public function getLayout()
	{
		
	
	}
}
