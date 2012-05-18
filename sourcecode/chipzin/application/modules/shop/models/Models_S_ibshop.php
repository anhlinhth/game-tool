<?php 
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_S_ibshop extends Models_Base
{
public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_ibshop";	
	}
public function insert($obj)
	{
		$id=$this->_insert($obj);
		return $id;
	}
	public  function deleteall()
	{
		$sql="
		DELETE FROM `s_ibshop` WHERE 1;
ALTER TABLE s_ibshop AUTO_INCREMENT=1;
		";
		$kq=$this->_db->query($sql);
		return kq;
		
	}
}
?>