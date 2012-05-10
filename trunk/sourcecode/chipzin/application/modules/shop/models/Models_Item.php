<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_Base.php';

class Models_Item extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_items";	
	}
public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					s_items
				WHERE
					1";
		if($objSearch)
			$sql .= " AND Name LIKE '%$objSearch%'";
		
		if($objSearch)
			$sql .= " AND ID = '$objSearch'";	
		if($objSearch)
			$sql .= " AND NameSV = '$objSearch'";						
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
					s_items
				WHERE
					1";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public function _deleteItem($id)
	{
		try 
		{
				$sql = "DELETE 
					FROM 
						s_items
					WHERE 
						ID = '$id';
						
					DELETE 
					
					FROM 
						s_items
					WHERE 
						ID = '$id'";
				 $temp = $this->_db->query($sql);
				
		//parent::_delete($id,null);
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
public  function isExistItem($objSearch)
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					s_items
				WHERE
					ID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
public function getAllItem()
	{
		$sql="
			SELECT 
				*
			FROM
				s_items
		";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);		
		
		return $data;
	}
	
	public function insertItem($obj)
	{
		try
		{
			$data = Utility::transferObjectToArray($obj);
			$this->_db->insert("s_items", $data);
			$id = $this->_db->lastInsertId();
			return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
}
?>
