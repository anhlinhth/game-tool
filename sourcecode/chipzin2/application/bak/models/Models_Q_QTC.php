<?php

require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Q_QTC extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "QTC_ID";
		$this->_table = "q_questtaskclient";		
	}
	
	public function insert($obj)
	{
		parent::_insert($obj);		
	}
	
	public function update($obj)
	{
		parent::_update($obj);
	}
	
	public function delete($id)
	{
		parent::_delete($id,null);
		
	}
	
	
		
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					q_questtaskclient
				WHERE
					1";
		
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	
	}
	
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(QTC_ID)
				FROM
					q_questtaskclient
				WHERE
					1";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public  function isExist($objSearch)
	{
		$sql = "SELECT
					COUNT(QTC_ID)
				FROM
					q_questtaskclient
				WHERE
					QTC_ID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public function getQuestLine()
	{		
				
	}
	
}
?>