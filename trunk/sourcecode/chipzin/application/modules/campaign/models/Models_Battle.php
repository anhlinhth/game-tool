<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Battle.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Battle extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_battle";	
	}
	public function delete($ID)
	{
	try
		{			
			$this->_db->delete('c_battle', "ID = '$ID'");			
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	public function getBattle($id)
	{
		$sql="
				SELECT 
					c_battle.*, c_layout.Point
				FROM
					c_battle,c_layout		
				WHERE Campaign =$id AND c_battle.Layout=c_layout.ID";		
		$data = $this->_db->fetchAll($sql,"", Zend_Db::FETCH_OBJ);
		return $data;
	}
	public function search($id)
	{
		$sql="
				SELECT 
					*
				FROM
					c_battle		
				WHERE Campaign ='$id'";		
		$data = $this->_db->fetchAll($sql);
		return $data;
	}
	public function saveBattle($obj)
	{
		parent::_update($obj);
	}
}
