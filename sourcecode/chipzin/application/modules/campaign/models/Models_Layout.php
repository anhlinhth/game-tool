<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Layout extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_layout";	
	}
	
	public function getLayout()
	{
		return parent::_filter();
	}
}
