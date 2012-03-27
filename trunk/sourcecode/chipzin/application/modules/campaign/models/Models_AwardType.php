<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

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
private function _deleteAwardType($id)
	{
		try 
		{
			$sql="SELECT
					*
					FROM
					c_award_type
					WHERE
					AwardTypeID ='$id' 
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
}
?>
