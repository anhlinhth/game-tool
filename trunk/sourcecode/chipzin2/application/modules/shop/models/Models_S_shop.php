<?php 
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_S_shop extends Models_Base
{
public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_shop";	
	}
public function insert($obj)
	{
		$id= $this->_insert($obj);
		return $id;
	}
	public function deleteall()
	{
		$sql="
		DELETE FROM `s_shop` WHERE 1;
ALTER TABLE s_shop AUTO_INCREMENT=1;
		";
		$kq=$this->_db->query($sql);
		return kq;
	}
	
	public function getIDShop($name)
	{
		$sql = "
		SELECT ID
		FROM s_shop
		WHERE Name = '$name'
		";
		
		return $this->_db->fetchAll($sql);
	}
	
	public function getShopClient()
	{
		$sql = "
		SELECT *
		FROM s_shop
		WHERE TypeID=1
		ORDER BY ID
		";
		
		return $this->_db->fetchAll($sql);
	}
}
?>