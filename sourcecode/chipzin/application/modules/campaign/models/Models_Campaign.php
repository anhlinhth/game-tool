<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'Object'.DS.'Obj_Campaign.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Campaign extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_campaign";		
	}
	
	public function insert($obj)
	{
		parent::_insert($obj);		
	}
	
	public function update($obj)
	{
		try{
		parent::_update($obj);}
		catch (Exception $e){echo $e;}
	}
	
	public function delete($id)
	{
		parent::_delete($id,null);
	}
	
	
		
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					c_campaign
				WHERE
					1";
		
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	
	}
	public function fetchname($objSearch)
	{
		$sql = "SELECT
					NAME
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";
		
		$data = $this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	
	}
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(QTC_ID)
				FROM
					c_campaign
				WHERE
					1";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public  function searchNext($objSearch)
	{
		$sql = "SELECT
					NextCamp
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public  function isExist($objSearch)
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public function getTopCampaign()
	{		
		$sql = "SELECT 
					*
				FROM
					c_campaign					
				WHERE
					1
				";
		
		$data = $this->_db->fetchRow($sql, "", Zend_Db::FETCH_OBJ);
		return $data;		
	}
	
public function getAllbattle()
	{
		$sql = "SELECT
					*
				FROM
					c_battle_soldier
				WHERE
					1
				";
		
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	
	}
}
?>