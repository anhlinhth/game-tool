<?php

require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_template extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "TaskID";
		$this->_table = "q_temp";		
	}
	public  function insert($obj)
	{
		parent::_insert($obj);
	}
	
	public  function update($obj)
	{
		parent::_update($obj);
	}
	
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					t.*,qa.*,qtc.*
				FROM
					q_temp as t, q_action as qa, q_questtaskclient as qtc
				WHERE
					1 AND t.ActionID = qa.ActionID AND t.QTC_ID = qtc.QTC_ID";
		
		if($objSearch->TaskID)
			$sql .= " AND t.TaskID LIKE '%$objSearch->TaskID%'";
		
		if($objSearch->ActionID)
			$sql .= " AND t.ActionID = '$objSearch->ActionID'";
		
		if($objSearch->TaskName)
			$sql .= " AND t.TaskName = '$objSearch->%TaskName%'";
		
		if($objSearch->QTC_ID)
			$sql .= " AND t.QTC_ID = '$objSearch->QTC_ID'";	
			
		if($order)
			$sql .= " ORDER BY $order";
		
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;		
	}
	
	public  function getID()
	{
		$sql ="	SELECT 
					(max(TaskID)+1) as TaskID
				FROM
					q_temp";
		$data = $this->_db->fetchAll($sql);
		return $data;
	}
}
?>