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

}
?>
