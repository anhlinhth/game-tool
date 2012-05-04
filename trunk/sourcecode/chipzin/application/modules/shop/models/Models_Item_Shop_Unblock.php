<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShopUnblock.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Item_Shop_Unblock extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_itemshop_unblock";	
	}
}
?>