<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Campaign.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Campaign extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_campaign";	
	}
	
	public function getcampaig($id)
	{
		parent::_getByKey($id);
	}
}
