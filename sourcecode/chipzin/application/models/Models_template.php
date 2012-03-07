<?php

require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_template extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "TaskID";
		$this->_table = "q_temp";		
	}
	public  function insert($obj)
	{
		parent::_insert($obj);
	}
}
?>