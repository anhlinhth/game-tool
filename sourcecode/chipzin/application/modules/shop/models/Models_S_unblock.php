<?php 
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_S_unblock extends Models_Base
{
public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_itemshop_unblock";	
	}
	
	public function insert($obj,$type)
	{
		try{
		$sql= "SELECT ID 
		FROM s_type_unblock
		 WHERE Name = '$type'
		";
	$typeID=$this->_db->fetchOne($sql);
	$obj->TypeUnblockID=$typeID;
	
	$id = $this->_insert($obj);
	return $id;
		}
		catch (Exception $e)
		{
			print_r("Error : \n");
			print_r($obj);
			print_r("\n");
			print_r($sql);
			die();
			
		}
	}
	public function deleteall()
	{
		$sql="
		DELETE FROM `s_itemshop_unblock` WHERE 1;
ALTER TABLE s_itemshop_unblock AUTO_INCREMENT=1;
		";
		$kq=$this->_db->query($sql);
		return kq;
	}
	
public function getItemUnblock($idItem)
	{
		$sql="
		SELECT *
		FROM s_itemshop_unblock
		WHERE ItemShopID=$idItem
		";
		
		return $this->_db->fetchAll($sql);
	}
}
?>