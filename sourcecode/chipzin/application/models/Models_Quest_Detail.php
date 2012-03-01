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
		parent::_insert($obj);		
	}
	
	public function update($obj)
	{
		//var_dump($obj);die();
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
	
	public function _getQuestLine()
	{
		$sql = "SELECT * FROM q_questline";
		$data = $this->_db->fetchAll($sql,"", Zend_Db::FETCH_OBJ);
		return $data;
				
	}
	
	public function getQuest($id = "")
	{
		$sql = "SELECT
					*
				FROM
					q_quest";
		if(!empty($id)){
			$sql."WHERE QuestID !=$id";
		}
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}

	public function filterQuest($arrID = Array())
	{
		//print_r($arrID);
		$sql = "SELECT
					QuestID,QuestName
				FROM
					q_quest
						WHERE 1 ";
		if (!empty($arrID)){
			foreach ($arrID as $value){
				$sql .= "AND QuestID != $value";
			}
		}	
	
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);		
		return $data;
	}
	
	public function getNeedQuest($questid)
		{
			$sql = "SELECT
						*
					FROM
						q_quest_needquest
							WHERE QuestID = $questid";
			
			$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);			
			return $data;
		}
	
	public function getTask($questid)
		{
			$sql = "SELECT
						*
					FROM
						q_task
					WHERE 
						QuestID= $questid";
			
			$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
			
			return $data;
		}
	
		public function getAwardItems($questid)
		{
			$sql = "SELECT
						*
					FROM
						q_quest_awarditem
							WHERE QuestID = $questid";
			
			$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);			
			return $data;
		}
}
	
	
?>