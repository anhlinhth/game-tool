<?php

require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Q_Task extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "TaskID";
		$this->_table = "q_task";		
	}
	
	
	public  function isExist($objSearch)
	{
		$sql = "SELECT
					COUNT(TaskID)
				FROM
					q_task
				WHERE
					QTC_ID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	
	
}
?>