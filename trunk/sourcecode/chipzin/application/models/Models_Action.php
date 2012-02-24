<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Action extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ActionID";
		$this->_table = "q_action";		
	}
	
	public function _getAction($ActionID)
	{
		$sql = "SELECT DISTINCT
					*
				FROM
					`q_action`
				";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function _getActionbyID($ActionID)
	{
		$sql = "SELECT
					ActionName
				FROM
					q_action
				WHERE
					ActionID = '".$ActionID."'
							";
				
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
}
?>
