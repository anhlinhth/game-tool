<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Base.php';
class Models_Award_Type extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_award_type";	
	}
	
	public function getAwardtype()
	{
		return parent::_filter();
	}
	
	public function insertAward($obj)
	{		
		try
		{
			$data = Utility::transferObjectToArray($obj);
			$this->_db->insert("c_award_type", $data);
			$id = $this->_db->lastInsertId();		
			return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}		
	}
}
