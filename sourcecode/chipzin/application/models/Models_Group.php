<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Group.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Group extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "group";		
	}
	
	public function getGroup()
	{
		$sql = "SELECT
					*
				FROM
					`group`
				WHERE
					id <> 1";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
}

?>
