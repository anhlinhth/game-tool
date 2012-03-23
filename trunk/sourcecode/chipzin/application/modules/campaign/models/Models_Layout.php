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
	public function getLayoutById($id)
	{
		$sql="
			SELECT
				 *
			FROM
				c_layout
			WHERE ID=$id		
		";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);	
		return $data;
	}
	public function insertLayout($obj)
	{
		parent::_insert($obj);
	}
}
