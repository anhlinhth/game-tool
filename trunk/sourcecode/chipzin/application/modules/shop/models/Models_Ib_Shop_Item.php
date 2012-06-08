<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_S_ibshop_item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Ib_Shop_Item extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_ibshop_item";	
	}
	public function add($obj)
	{
		parent::_insert($obj);
	}
	
	public function delete($id)
	{
		if(!empty($id)){
		$sql="DELETE From s_ibshop_item WHERE s_ibshop_item.IbShopID ={$id}";
		}
		$this->_db->query($sql);
	}
}