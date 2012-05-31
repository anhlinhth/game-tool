<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Quest_Task_Client extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "QTC_ID";
		$this->_table = "q_questtaskclient";		
	}
	
	
	public function _getQuestTaskClient()
	{
		$sql = "SELECT DISTINCT
					*
				FROM
					`q_questtaskclient`
				";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	public function _getQuestTaskClientByID($QTC_ID)
	{
		$sql = "SELECT
					QTC_Name
				FROM
					q_questtaskclient
				WHERE
					QTC_ID = '".$QTC_ID."'
							";
				
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
}
?>
