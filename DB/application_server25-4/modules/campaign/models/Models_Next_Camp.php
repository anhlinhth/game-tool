<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Battle.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Next_Camp extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_nextcamp";	
	}
	public function delete($ID)
	{
	try
		{			
			$this->_db->delete('c_nextcamp', "ID = '$ID'");			
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	public function getnextmap($idBattle)
	{
		$sql ="SELECT 
					*
				FROM
					c_nextcamp
				WHERE
					CampID = $idBattle";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
}
