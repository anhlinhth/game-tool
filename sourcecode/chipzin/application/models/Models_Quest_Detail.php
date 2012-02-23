<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Quest_Detail extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "QuestID";
		$this->_table = "q_quest";		
	}
	
	public function insert($obj)
	{
		
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
	
	}
	
	public function count($objSearch)
	{
		
	}
	
	public function getQuestLine()
	{
		$sql = "SELECT * FROM q_questline";
		$data = $this->_db->fetchAll($sql,"", Zend_Db::FETCH_OBJ);
		return $data;
				
	}
	
	public function getQuest()
	{
		$sql = "SELECT
					*
				FROM
					q_quest";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
public function getnextQuest($id)
	{
		$sql = "SELECT
					*
				FROM
					q_quest 
					where
						QuestID !=$id";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function getNeedQuest($questid)
		{
			$sql = "SELECT
						*
					FROM
						q_quest_needquest
						WHERE QuestID= $questid";
			
			$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
			
			return $data;
		}
	
	public function getTask($questid)
		{
			$sql = "SELECT
						*
					FROM
						q_task
						WHERE QuestID= $questid";
			
			$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
			
			return $data;
		}
	
		public function getAwardItems($questid)
		{
			$sql = "SELECT
						*
					FROM
						q_quest_awarditem
						WHERE QuestID= $questid";
			
			$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
			
			return $data;
		}
}
	
	
?>