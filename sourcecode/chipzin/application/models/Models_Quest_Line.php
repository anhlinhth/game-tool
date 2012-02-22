<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Quest_Line extends Models_Base
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
	
	private function isExist($alias)
	{
		
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
	
	public function getQuestLine()
	{		
				
	}
	
}
?>