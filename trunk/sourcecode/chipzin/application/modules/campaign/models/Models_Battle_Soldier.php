<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Battle_Soldier extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_battle_soldier";	
	}
	
	public function getbattle_soldier($idBattle)
	{
		$sql ="SELECT 
					*
				FROM
					c_battle_soldier
				WHERE
					BattleID = $idBattle";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	public function getAllSoldier()
	{
		$sql ="SELECT 
					*
				FROM
					c_battle_soldier
				";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	public function deleteB_Soldier($id)
	{
		$sql = "DELETE FROM
					c_battle_soldier
				WHERE
					BattleID = $id";
		$this->_db->query($sql);
	}
	
	public function delete($ID)
	{
	try
		{			
			$this->_db->delete('c_battle_soldier', "ID = '$ID'");			
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	
	public function updateB_Soldier($obj)
	{
		parent::_insert($obj);
	}
}
