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
	
	
$id = parent::_update($obj);
return $id;
}
    
}