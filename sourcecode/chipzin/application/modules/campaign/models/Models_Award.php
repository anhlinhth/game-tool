<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Award extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_award";	
	}
	public function getAward($idBattle)
	{
		$sql ="SELECT
					*
				FROM
					c_award
				WHERE
					BattleID = $idBattle";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	public function getAwardType()
	{
		$sql ="SELECT
				*
				FROM
				c_award_type";				
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	////////////////ThaoNX/////////////////////
	
	//////////////////////////////////
	public function insertAward($battleID)
	{
		try
		{
			$data = array('BattleID'=>$battleID,'AwardTypeID'=>null);
    		$this->_db->insert('c_award', $data);
    		$id = $this->_db->lastInsertId();
    		return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	///////////////////////////////
	public function deleteAward($ID)
	{
		try
		{			
			$this->_db->delete('c_award', "ID = '$ID'");			
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	///////////////////////////////////////
	public function updateAwardType($ID,$Type)
	{
		try
		{
			$data = array('AwardTypeID'=>$Type);			
			$this->_db->update('c_award', $data, "ID = $ID");
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	/////////////////////////////////////////
	public function updateAward($battleID,$arrType,$arrValue)
	{
		try
		{
			$sql="
				DELETE
				FROM c_award				
				WHERE 
					BattleID='".$battleID."';
			";
			
			foreach ($arrType as $key => $type){
			    $sql.= "INSERT INTO c_award (ID, BattleID,AwardTypeID,Value) VALUES (NULL, $battleID, $type, $arrValue[$key]);";
			}			
			$data=$this->_db->query($sql);
			return $data;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
public function getnoType($id)
    {
        $sql = "SELECT
			COUNT(AwardTypeID)
			FROM
			c_award
			WHERE AwardTypeID='" . $id . "'
			";
        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
        return $count;
    }
public function getType($id)
    {
        $sql = "SELECT
			c_battle.ID,AwardTypeID,BattleID,Campaign
			FROM
			c_award,c_battle
			WHERE AwardTypeID='" . $id . "' AND c_battle.ID=c_award.BattleID
			";
        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
        return $data;
    }
	///////////////Tan/////////////
	public function  delAward($id)
	{
		$sql ="	DELETE FROM
					c_award
				WHERE
					BattleID = $id";
		$this->_db->query($sql);
	}
	
	public function InsAward($obj)
	{
		parent::_insert($obj);
	}
}
