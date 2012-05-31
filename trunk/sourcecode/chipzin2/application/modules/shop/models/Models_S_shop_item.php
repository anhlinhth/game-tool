<?php 
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_S_shop_item extends Models_Base
{
public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_shop_item";	
	}
public function insert($obj)
	{
		$id=$this->_insert($obj);
		return $id;
	}
	public function deleteall()
	{
		$sql="
		DELETE FROM `s_shop_item` WHERE 1;
ALTER TABLE s_shop_item AUTO_INCREMENT=1;
		";
		$kq=$this->_db->query($sql);
		return kq;
		
	}
	
	public function getItemsID($idshop)
	{
		try{
		$sql = "
		SELECT ItemID
		From s_shop_item
		WHERE ShopID=$idshop
		";
		
		return $this->_db->fetchAll($sql);
		}
		catch (Exception $e)
		{
			//print_r($idshop);die();
		}
	}
}
?>