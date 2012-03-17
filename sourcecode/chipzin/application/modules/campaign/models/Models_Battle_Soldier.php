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
	
	public function getbattle_soldier($idBattel)
	{
		$sql ="SELECT 
					*
				FROM
					c_battle_soldier
				WHERE
					BattleID = $idBattel";
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
}
