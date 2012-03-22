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
	
	public function getBattle($id)
	{
		$sql="
				SELECT 
					c_battle.*, c_layout.Point
				FROM
					c_battle,c_layout		
				WHERE Campaign =$id AND c_battle.Layout=c_layout.ID 
				ORDER BY c_battle.Order ASC";		
		$data = $this->_db->fetchAll($sql,"", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	public function saveBattle($obj)
	{
		parent::_update($obj);
	}
	///////////////////ThaoNX////////////////////////
	public function delete($battleID)
	{
		try
		{
		    $sql="
		    	DELETE
		    		FROM c_award
		    	WHERE
		   			 BattleID='".$battleID."';

		   		DELETE
		    		FROM c_battle_soldier
		    	WHERE
		   			 BattleID='".$battleID."';
		   			 
		   		DELETE
		    		FROM c_battle
		    	WHERE
		   			ID='".$battleID."';	 
		    	";		    	
		    $data=$this->_db->query($sql);
		   
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	public function getBattleInfo($id)
	{
		$sql="
		SELECT
		c_battle.*, c_layout.Point
		FROM
		c_battle,c_layout
		WHERE c_battle.ID ='$id' AND c_battle.Layout=c_layout.ID
		ORDER BY c_battle.Order ASC";
		$data = $this->_db->fetchRow($sql,"", Zend_Db::FETCH_OBJ);
		return $data;
	}
}
