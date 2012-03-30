<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'Object' .
    DS . 'Obj_WorldMap.php';

class Models_C_World extends Models_Base
{
	
 public function __construct()
    {
        parent::__construct();
        $this->_key = "ID";
        $this->_table = "c_worldmap";
    }

public function insert($obj)
{
$id = $this->isExit($obj->Name);
if($id== null)
{
$idnew= $this->_insert($obj);
return $idnew;
}
else return $id;
}

public function isExit($name)
{
$sql = "Select ID From c_worldmap Where Name='$name'";
$ida= $this->_db->fetchOne($sql);
return $ida;
}
    
}