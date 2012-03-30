<?php
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'Object' .
    DS . 'Obj_Campaign.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_Campaign extends Models_Base
{
    public function __construct()
    {
        parent::__construct();
        $this->_key = "ID";
        $this->_table = "c_campaign";
    }

    public function insert($obj)
    {
        parent::_insert($obj);
    }

    public function update($obj)
    {
        try {
            parent::_update($obj);
        }
        catch (exception $e) {
            echo $e;
        }
    }

    public function delete($value)
    {
        try
		{
	        $sql = "DELETE FROM 
						c_award
					WHERE 
						BattleID IN (SELECT c_battle.ID FROM c_battle WHERE c_battle.Campaign=$value);

					DELETE FROM 
						c_battle_soldier
					WHERE 
						BattleID IN (SELECT c_battle.ID FROM c_battle WHERE c_battle.Campaign=$value);
						
					DELETE FROM
						c_battle
					WHERE 
						CamPaign=$value;

					DELETE FROM
						c_nextcamp
					WHERE 
						CampID=$value OR NextCamp=$value;	
							
					UPDATE
						c_campaign	SET
							NeedCamp = NULL
						WHERE
							NeedCamp = $value;
									
					DELETE FROM
						c_campaign
					WHERE 
						ID=$value;";  	
            
	        $temp = $this->_db->query($sql);
	        
    	}
    	catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}
            
    }


    public function filter($objSearch, $order, $offset, $count)
    {
        $sql = "SELECT
					*
				FROM
					c_campaign
				WHERE
					1";

        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);

        return $data;

    }
    public function fetchall()
    {
        $sql = "SELECT
					*
				FROM
					c_campaign
				WHERE
					1";

        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);

        return $data;

    }
    public function fetchname($objSearch)
    {
        $sql = "SELECT
					NAME
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";

        $data = $this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);

        return $data;

    }
    public function count($objSearch)
    {
        $sql = "SELECT
					COUNT(QTC_ID)
				FROM
					c_campaign
				WHERE
					1";

        $count = $this->_db->fetchOne($sql);

        return $count;
    }
    public function searchNext($objSearch)
    {
        $sql = "SELECT
					NextCamp
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";

        $count = $this->_db->fetchOne($sql);

        return $count;
    }
    public function fetchone($objSearch)
    {
        $sql = "SELECT
					*
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";

        $count = $this->_db->fetchRow($sql);

        return $count;
    }
    public function isExist($objSearch)
    {
        $sql = "SELECT
					COUNT(ID)
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";

        $count = $this->_db->fetchOne($sql);

        return $count;
    }
    public function getTopCampaign()
    {
        $sql = "SELECT 
					*
				FROM
					c_campaign					
				WHERE
					1
				";

        $data = $this->_db->fetchRow($sql, "", Zend_Db::FETCH_OBJ);
        return $data;
    }

    public function getAllbattle()
    {
        $sql = "SELECT
					*
				FROM
					c_battle_soldier
				WHERE
					1
				";

        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);

        return $data;

    }

    ///////////////////////////////////////
    public function getAllCampaign()
    {
        $sql = "SELECT
					*
				FROM
					c_campaign
				WHERE
					1";

        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);

        return $data;

    }
    /////////////////////////////////////////
    public function getAllMapType()
    {
        $sql = "SELECT
		*
		FROM
		c_typemap
		WHERE
		1";
        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);

        return $data;
    }
    ///////////////////////////////////////////////
    public function getNextCamp($id)
    {
        $sql = "SELECT
			*
			FROM
			c_nextcamp
			WHERE CampID='" . $id . "'
			";
        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
        return $data;
    }
public function getType($id)
    {
        $sql = "SELECT
			COUNT(ID)
			FROM
			c_campaign
			WHERE TypeID='" . $id . "'
			";
        $data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
        return $count;
    }
    /////////////////////////////////////////////////
    public function getCampaignById($id)
    {
        $sql = "SELECT
					*
				FROM
					c_campaign
				WHERE
					ID=$id";

        $data = $this->_db->fetchRow($sql, "", Zend_Db::FETCH_OBJ);
        return $data;
    }
    ////////////////////////tan////////////////////
    public function getCampaignByLayout($id)
    {
    	$sql = "SELECT 
    				c.ID, c.Name 
    			FROM 
    				c_campaign c 
    			WHERE 
    				c.ID IN(	SELECT 
    								Campaign 
    							FROM 
    								c_battle 
    							WHERE 
    								Layout = $id)";
    
    	$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
    	return $data;
    }
    //////////////////////////////////////////////////
    public function resetNextCamp($id)
    {
        try {
            $this->_db->delete("c_nextcamp", "CampID = '$id'");
        }
        catch (Zend_Db_Exception $ex) {
            throw new Internal_Error_Exception($ex);
        }
    }
    /////////////////////////
    public function insertNextCamp($obj)
    {
        try {
            $data = Utility::transferObjectToArray($obj);
            $this->_db->insert('c_nextcamp', $data);
            $id = $this->_db->lastInsertId();
            return $id;
        }
        catch (Zend_Db_Exception $ex) {
            throw new Internal_Error_Exception($ex);
        }
    }
    
}
?>