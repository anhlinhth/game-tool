<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShopRequire.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Item_Shop_Require extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_itemshop_require";	
	}
	public function update($obj)
	{
		parent::_update($obj,null);
	}
	public function delete($id)
	{
		$sql="
			DELETE 
				FROM
			s_itemshop_require
			WHERE
			 s_itemshop_require.ItemShopID=$id
		";
		$this->_db->query($sql);
			
	}
}
?>