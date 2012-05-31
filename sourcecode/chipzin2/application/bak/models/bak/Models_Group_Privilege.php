<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Group_Privilege.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Group_Privilege extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "group_privileges";		
	}
	
	public function getGroupPrivilege($groupId, $privilegeId)
	{
		$sql = "SELECT
					*
				FROM
					group_privileges
				WHERE
					group_id = '$groupId'
					AND privilege_id = '$privilegeId'";
		
		$data = $this->_db->fetchRow($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
}
?>
