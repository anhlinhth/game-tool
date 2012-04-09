<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_C_Battle extends Models_Base
{

 public function __construct()
    {
        parent::__construct();
        $this->_key = "ID";
        $this->_table = "c_battle";
    }
	
public function insert($obj)
{
	$sql= "SELECT ID 
		FROM c_layout
		ORDER BY RAND( ) 
		LIMIT 1";
	$lo=$this->_db->fetchOne($sql);
	$obj->Layout=$lo;
	
$id = parent::_insert($obj);
return $id;
}

public function update($obj)
{
	
	
	$id=$obj->ID;
	$lay=$obj->Layout;
	
	
	$sql1="select * from c_battle where ID=$id";
	$data=$this->_db->fetchAll($sql1);
	
$obj->Campaign=$data[0]['Campaign'];
$obj->Order=$data[0]['Order'];


	//$sql="Update c_battle
///	Set Layout=$lay
	////Where BattleID=$id
	//";
	
$i = parent::_update($obj);
return $i;
}
    
}