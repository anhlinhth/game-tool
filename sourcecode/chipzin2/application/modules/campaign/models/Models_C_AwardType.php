<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_C_AwardType extends Models_Base
{
public function __construct()
	{	
		parent::__construct();		
		$this->_key = "AwardTypeID";
		$this->_table = "c_award_type";	
	}
	public function getAllType()
	{
		$sql ="SELECT
					*
				FROM
					c_award_type
				WHERE
					1";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	public function getIDType($name)
	{
		$all=$this->getAllType();
	foreach ($all as $val)
	{
	if(strtolower($val->Name)==$name)
	{
	return $val->AwardTypeID;
	}
	}
	}
}