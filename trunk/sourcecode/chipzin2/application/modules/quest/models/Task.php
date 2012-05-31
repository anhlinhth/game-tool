<?php

class Quest_Model_Task extends Base_Model
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "TaskID";
		$this->_table = "q_task";		
	}
	
	public function findid()
	{
		$sql = "SELECT
					(max(QuestID) + 1)
				FROM
					q_quest";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function findidTask()
	{
		$sql = "SELECT
					(max(TaskID) + 1) as ID
				FROM
					q_task";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	public function findtemplate()
	{
		$sql = "SELECT
					*
				FROM
					q_task
				WHERE Template = 1";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	public  function listQuestInTask()
	{
		$sql = "SELECT DISTINCT
					QuestID
				FROM
					q_task";
				
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
}
?>
