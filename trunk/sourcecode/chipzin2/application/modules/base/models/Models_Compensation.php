<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
class Models_Compensation extends Models_Base
{
	public function __construct()
	{
		parent::__construct();	
	}
	// public function getValuesChanged(){
		// $sql = "SELECT
						// *
					// FROM
						// cp_valuechanged
					// WHERE
						// 1";
		// $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);

		// return $data;
	// }
	public function getOptions(){
		$sql = "SELECT
						*
					FROM
						cp_options
					WHERE
						1";
		$data = $this->_db->fetchRow($sql, "", Zend_Db::FETCH_OBJ);

		return $data;
	}
	
	public function getLogs(){
		
		$sql = "SELECT
						*
					FROM
						cp_logs
					WHERE
						1";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	public function countLogSession(){
		$sql = "SELECT
						COUNT(SessionID)
					FROM
						cp_logs_session
					WHERE
						1";
		$data = $this->_db->fetchOne($sql);
		return $data;
	}
	
	
	public function getLogSession($page,$num){
		$start = ($page - 1) * $num;
		$sql = "SELECT
						*
					FROM
						cp_logs_session
					WHERE
						1  LIMIT $start,$num";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	public function getLogDetail($sessionID){
		$sql = "SELECT
						*
					FROM
						cp_logs
					WHERE
						SessionID=$sessionID";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	public function deleteLog($id){
		try
		{
			$this->_db->delete("cp_logs", "ID = '$id'");
    	}
    	catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}
	}
	
	public function updateOptions($obj){
		try
		{
			$data = Utility::transferObjectToArray($obj);			
			$key = $data[$this->_key];
			unset($data[$this->_key]);			
			$this->_db->update("cp_options", $data, "1");
    		return $key;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}    	
	}
	public function logs($obj){
		try
		{
			$data = Utility::transferObjectToArray($obj);
    		$this->_db->insert("cp_logs", $data);
    		$id = $this->_db->lastInsertId();
    		return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
		//$count = $this->_db->fetchOne($sql);
		
	}
	public function createSession($item){
		try
		{
			$data = Utility::transferObjectToArray($item);
    		$this->_db->insert("cp_logs_session", $data);
    		$id = $this->_db->lastInsertId();
    		return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
		//$count = $this->_db->fetchOne($sql);
		
	}
	public function saveChanged($obj){

		try
		{
			$data = Utility::transferObjectToArray($obj);
    		$this->_db->insert("cp_valuechanged", $data);
    		$id = $this->_db->lastInsertId();
    		return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
		//$count = $this->_db->fetchOne($sql);
		
	}
}