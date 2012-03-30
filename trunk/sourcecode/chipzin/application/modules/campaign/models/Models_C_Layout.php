<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_C_Layout extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_layout";	
	}
	

	public function getLayout($name)
	{
		$sql="
			SELECT
				 *
			FROM
				c_layout
			WHERE Name='$name'
			Limit 1		
		";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);	
		return $data;
	}
	
	
	
}
