<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Type_Shop extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_type_shop";	
	}		
	public function getTypeShop()
	{
		$sql="SELECT * FROM s_type_shop WHERE 1";
		$data=$this->_db->fetchAll($sql,"",Zend_Db::FETCH_OBJ);
		return $data;
	}	
}
?>
