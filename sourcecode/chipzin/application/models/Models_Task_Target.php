<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task_Target.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Task_Target extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "q_task_target";		
	}
	
	public function findid()
	{
		$sql = "SELECT
					(max(ID) + 1) as ID
				FROM
					q_task_target";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function delete($value)
	{
		try
		{
	        $sql = "DELETE FROM 
	        			q_task_target
	        		WHERE
	        			TaskID = '$value'
	        		";
	      	
	        $temp = $this->_db->query($sql);
	        $result = $temp->rowCount();
    	}
    	catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}
    }
}
?>
