<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_S_version extends Models_Base
{

	public function getVer()
	{
	$sql = "Select Version From s_version limit 1";
	
	return $this->_db->fetchAll($sql);
	
	}
	
	public function updateVer()
	{
	$sql = "Update s_version Set Version= Version+1 ";
	
	return $this->_db->query($sql);
	}
	
	public function insert()
	{
	if ($this->isExit()==0)
	{
	$sql = "INSERT INTO s_version(ID, Version) VALUES (1,1)";
	return $this->_db->query($sql);
	}
	
	}
	
	public function isExit()
	{
	$sql = "Select COUNT(ID) From s_version ";
	if($this->_db->query($sql)==0)
		return 0;
	else 
		return 1;
	}
}