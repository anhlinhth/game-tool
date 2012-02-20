<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Privilege.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Privilege extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "privileges";		
	}	
	
	public function getPrivilegeByControllerAndAction($controllerName, $actionName)
	{
		$sql = "SELECT
					*
				FROM
					privileges
				WHERE
					controller_name = '$controllerName'
					AND
					action_name = '$actionName'";
		
		$data = $this->_db->fetchRow($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function getPrivilegeByController($controllerName)
	{
		$sql = "SELECT
					*
				FROM
					privileges
				WHERE
					controller_name = '$controllerName'";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
}
?>
