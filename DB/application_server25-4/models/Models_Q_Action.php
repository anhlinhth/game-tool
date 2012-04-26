<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Q_Action extends Models_Base
{
public function __construct()
	{
		parent::__construct();		
		$this->_key = "ActionID";
		$this->_table = "q_action";		
	}
	
public function Insert($obj)
{		
	$id = $this->isExist($obj->ActionID);
	if($id)
	return FALSE;
	else 	
	parent::_insert($obj);
	
}

public function Update($obj)
 {
 	$id = $this->isExist($obj->ActionID);
 	if($id)
			parent::_update($obj);		
		else {
			return FALSE;
		}
}

public function Truncate($obj)
{
	
	$sql = "DELETE FROM `q_action` WHERE 1;
ALTER TABLE q_action AUTO_INCREMENT=1"; 
		
		$id= $this->_db->query($sql);
		
		return $id;
	
}

public function isExist($ActionID)
	{
		$sql = "SELECT
					ActionID
				FROM
					q_action
				WHERE
					ActionID = '$ActionID'";
		
		$id = $this->_db->fetchOne($sql);
		
		return $id;
	}
	
}
?>