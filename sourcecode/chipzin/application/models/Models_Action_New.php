<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Action_New extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ActionID";
		$this->_table = "q_action";		
	}
	
	public function insert($obj)
	{
		parent::_insert($obj);		
	}
	
	public function update($obj)
	{
		parent::_update($obj);
	}
	
	private function _deleteAction($id)
	{
		try 
		{
			$sql="SELECT
					*
					FROM
					q_action
					WHERE
					ActionID ='$id' 
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
	
	public function setStatus($id,$status)
	{
		
	}
	
	public function getGiftType()
	{
		
	}
	
	public function generate($data)
	{
		
	}
	
	
	
	public function sync($data,$itemData,$saleOffShopData,$location)
	{
		
	}
		
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					q_action
				WHERE
					1";
		
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	
	}
	
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(ActionID)
				FROM
					q_action
				WHERE
					1";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public  function isExistAction($objSearch)
	{
		$sql = "SELECT
					COUNT(ActionID)
				FROM
					q_task
				WHERE
					ACtionID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public function getQuestLine()
	{		
				
	}
	
}
?>