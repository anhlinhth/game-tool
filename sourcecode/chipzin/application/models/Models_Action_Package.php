<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Action_Package extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "q_action";		
	}
}
?>