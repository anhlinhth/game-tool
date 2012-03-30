<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'Object'.DS.'Obj_WorldMap.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_WorldMap extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_worldmap";		
	}
	public function searchname($param) {
		$sql = "SELECT
					ID
				FROM
					c_worldmap
				WHERE
					Name = '$param'";
		$data = $this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	public function insert($obj)
	{
		parent::_insert($obj);		
	}
	
	public function update($obj)
	{
		parent::_update($obj);
	}
	
	public function delete($id)
	{
		parent::_delete($id,null);
		
	}
	
	public function fetchall()
	{
		$sql = "SELECT
					*
				FROM
					c_worldmap
				WHERE
					1";
		
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	}
		
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					c_worldmap
				WHERE
					1";
		if($objSearch)
			$sql .= " AND ID =$objSearch";
		
		if($objSearch)
			$sql .= " AND Name LIKE '$objSearch'";						
		if($order)
			$sql .= " ORDER BY $order";
		
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);		
		
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
	public  function isExistWolrdmap($objSearch)
	{
		$sql = "SELECT
					COUNT(WorldMap)
				FROM
					c_campaign
				WHERE
					WorldMap='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
}