<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Gift_Package_Detail extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "gift_package_detail";		
	}
}
?>
