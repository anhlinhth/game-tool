<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Battle.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Battle extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_battle";	
	}
	
	public function getBattle($id)
	{

	}
}
