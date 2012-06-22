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
	
	public function getQuest2($id = "")
	{
		$sql = "SELECT
			QuestID,QuestName 
		FROM
			q_quest ORDER BY QuestName ASC";
		if(!empty($id)){
			$sql."WHERE QuestID !=$id ";
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
	
	public function getNextQuest($questid)
		{
			$sql = "SELECT
						*
					FROM
						q_NextQuest							 	
							WHERE QuestID = $questid
								ORDER BY  ID ASC ";
			
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
	
		public function getAward($questid)
		{
			$sql = "SELECT
						*
					FROM
						q_award
							WHERE QuestID = $questid";
			
			$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);			
			return $data;
		}
		
		public function insertNextQuest($obj){
		    
		    $data = (array)$obj;
		    $this->_db->insert('q_NextQuest', $data);
		    $id = $this->_db->lastInsertId();
		    return $id;
		}
		public function deleteNextQuest($id,$questID=null,$nextquest=null){
		    $this->_db->delete('q_NextQuest', "ID=$id");
		}
		
		public function updateNextQuest($obj){		
			try
			{
				$data = Utility::transferObjectToArray($obj);
				$key = $data[ID];
				unset($data[ID]);			
				$this->_db->update('q_NextQuest', $data, "ID = $key");	
	    		return $key;
			}
			catch(Zend_Db_Exception $ex)
			{
				throw new Internal_Error_Exception($ex);
	    	}    
		}
}
	
	
?>