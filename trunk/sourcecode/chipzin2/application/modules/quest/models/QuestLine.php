<?php
class Quest_Model_QuestLine extends Base_Model
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "QuestLineID";
		$this->_table = "q_questline";		
	}
	
	public function insert($obj)
	{
		parent::_insert($obj);		
	}
	
	public function update($obj)
	{
		parent::_update($obj);
	}
	
	public function search($idQL)
	{
	
			$sql="SELECT
					QuestLineIcon
					FROM
					q_questline
					WHERE
					QuestLineID ='$idQL' 
					";
			
			$dt=$this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);
			
		return 	 $dt;
		
		
	}
	
	private function _deleteQuestLine($id)
	{
		try 
		{
			$sql="SELECT
					*
					FROM
					q_quest
					WHERE
					QuestLineID ='$id' 
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
					q_questline
				WHERE
					1";
		if($objSearch)
			$sql .= " AND QuestLineName LIKE '%$objSearch%'";
		
		if($objSearch)
			$sql .= " AND QuestLineID = '$objSearch'";						
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
					COUNT(QuestLineID)
				FROM
					q_questline
				WHERE
					1";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public  function isExistQuestLine($objSearch)
	{
		$sql = "SELECT
					COUNT(QuestLineID)
				FROM
					q_quest
				WHERE
					QuestLineID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public function getQuestIne()
	{		
	    $sql = "SELECT
	    	* 
	    	FROM
	    		q_quest
	    	WHERE
	    		QuestLineID='$'";
	}
	
}
?>