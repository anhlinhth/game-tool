<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_S_Type_Get extends Models_Base
{

	public function getNameKind($id)
	{
		$sql="
		SELECT Name
		FROM s_type_kind
		WHERE ID=$id
		";
		
		return $this->_db->fetchAll($sql);
	}
	
	
public function getTypeReq($id)
	{
		$sql="
		SELECT Name
		FROM s_type_require
		WHERE ID=$id
		";
		
		return $this->_db->fetchAll($sql);
	}
public function getTypeUnblock($id)
	{
		$sql="
		SELECT Name
		FROM s_type_unblock
		WHERE ID=$id
		";
		
		return $this->_db->fetchAll($sql);
	}
	
}