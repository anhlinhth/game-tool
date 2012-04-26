<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Temp_Target.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Temp_Target extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "q_temp_target";		
	}
	
	public function findid()
	{
		$sql = "SELECT
					(max(ID) + 1) as ID
				FROM
					q_temp_target";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function select($value)
	{
		$sql = "SELECT
					qtt.ID,qtt.TargetID,qtt.TaskID
				FROM
					q_temp_target qtt, q_temp qt
				WHERE 
					qt.QuestID= '$value'
				AND
					qt.TaskID = qtt.TaskID;";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function delete($value)
	{
		try
		{
	        $sql = "DELETE FROM 
	        			q_temp_target
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
    
	public function insert($obj)
	{
		parent::_insert($obj);
    }
    
    public  function selectTarget($id)
    {
    	$sql = "SELECT
					*
				FROM
					q_temp_target
				WHERE 
					TaskID= '$id';";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
    }
}
?>
