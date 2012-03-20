<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Worldmap.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Worldmap extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_Worldmap";	
	}
public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					c_Worldmap
				WHERE
					1";
		if($objSearch)
			$sql .= " AND Name LIKE '%$objSearch%'";
		
		if($objSearch)
			$sql .= " AND ID = '$objSearch'";						
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
					COUNT(ID)
				FROM
					c_Worldmap
				WHERE
					1";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
private function _deleteWorldmap($id)
	{
		try 
		{
			$sql="SELECT
					*
					FROM
					c_Worldmap
					WHERE
					ID ='$id' 
					";
			
			$count=$this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
			print_r($count);
//			if($count < 1)
//				$this->_db->delete($this->_table, "$this->_key = '$id'");
//			else
//				echo ("Xoa khong thanh cong");
//				 
		}
		catch (Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);	
		}
		
	}
public function update($obj)
	{
		var_dump($obj);
		die();
		parent::_update($obj);
	}
public function insert($obj)
	{
		parent::_insert($obj);		
	}
public  function isExistWorldmap($objSearch)
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					c_Worldmap
				WHERE
					ID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
}
?>
