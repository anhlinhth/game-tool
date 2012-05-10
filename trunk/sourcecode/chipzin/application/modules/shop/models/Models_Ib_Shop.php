<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_S_ibshop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Ib_Shop extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_ibshop";	
	}
	
	public function getibshopByID($id)
	{
		$sql="	SELECT *
				FROM 
					s_ibshop
				WHERE
					ID = 1";
		$result=$this->_db->fetchOne($sql);
		return $result;
	}
}
?>