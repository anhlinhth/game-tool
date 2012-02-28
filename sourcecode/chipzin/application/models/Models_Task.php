<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Task extends Models_Base
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
}
?>
