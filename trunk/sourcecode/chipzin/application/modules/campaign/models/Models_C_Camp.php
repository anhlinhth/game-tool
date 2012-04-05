<?php
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'Object' .
    DS . 'Obj_Campaign.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_C_Camp extends Models_Base
{
    public function __construct()
    {
        parent::__construct();
        $this->_key = "ID";
        $this->_table = "c_campaign";
    }

    public function insert($obj)
    {
    	
	
    	$id= parent::_insert($obj);
return $id;
        
    }

 public function deleteAll($world)
 {
  		$id = $this->All($world);
		if($id != null)
		{
		foreach ($id as $i)
		{
			//var_dump($i['ID']);
			//die();
			$this->deleteOne($i['ID']);			
		}
		}
 	
 }

 public function deleteSome($world,$campName)
 {
  		$id = $this->Some($world, $campName);
  		//var_dump($id);
		if($id != null)
		{
		foreach ($id as $i)
		{
			
			$this->deleteOne($i['ID']);			
		}
		}
 	
 }
    public function deleteOne($value)
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
   
    
    
    public function All($world)
    {
        $sql = "SELECT
					ID
				FROM
					c_campaign
				WHERE
					WorldMap ='$world'";

        $ida = $this->_db->fetchAll($sql);

        return $ida;
    }
 
    
 public function Some($world,$camp)
    {
        $sql = "SELECT
					ID
				FROM
					c_campaign
				WHERE
				Name='$camp' AND 
				WorldMap = '$world'";

        $ida = $this->_db->fetchAll($sql);

        return $ida;
    }
    /////////////////////////////////////////


}
?>