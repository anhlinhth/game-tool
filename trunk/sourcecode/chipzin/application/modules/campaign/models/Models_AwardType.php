<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Base.php';

class Models_AwardType extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "AwardTypeID";
		$this->_table = "c_award_type";	
	}
public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					c_award_type
				WHERE
					1";
		if($objSearch)
			$sql .= " AND Name LIKE '%$objSearch%'";
		
		if($objSearch)
			$sql .= " AND AwardTypeID = '$objSearch'";						
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
					COUNT(AwardTypeID)
				FROM
					c_award_type
				WHERE
					1";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public function _deleteAwardType($id)
	{
		try 
		{
				$sql = "DELETE 
					FROM 
						c_award
					WHERE 
						AwardTypeID = '$id';
						
					DELETE 
					
					FROM 
						c_award_type
					WHERE 
						AwardTypeID = '$id'";
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
public  function isExistAwardType($objSearch)
	{
		$sql = "SELECT
					COUNT(AwardTypeID)
				FROM
					c_award_type
				WHERE
					AwardTypeID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
public function getAllAwardType()
	{
		$sql="
			SELECT 
				*
			FROM
				c_award_type
		";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);		
		
		return $data;
	}
	
	public function insertAward($obj)
	{
		try
		{
			$data = Utility::transferObjectToArray($obj);
			$this->_db->insert("c_award_type", $data);
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
