<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';


class Models_C_BattleSold extends Models_Base
{

 public function __construct()
    {
        parent::__construct();
        $this->_key = "ID";
        $this->_table = "c_battle_soldier";
    }
	
public function insert($obj)
{
	
		
$sql= "SELECT ID 
		FROM c_soldier
		ORDER BY RAND( ) 
		LIMIT 1";
	$so=$this->_db->fetchOne($sql);
	$obj->Soldier=$so;
	
	parent::_insert($obj);
}
    
}