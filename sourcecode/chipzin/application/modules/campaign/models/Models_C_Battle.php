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
	
public function insert($obj,$layout)
{
	$sql= "Select ID From c_layout Where Name='$layout'";
	$lo=$this->_db->fetchOne($sql);
	$obj->Layout=$lo;
$id = parent::_insert($obj);
return $id;
}
    
}