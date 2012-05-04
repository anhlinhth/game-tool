<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Shop extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_itemshop";	
	}
		
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					s_shop
				WHERE
					1 ";
		
		if($objSearch->ID)
			$sql .= " AND ID = '$objSearch->ID'";						
		if($order)
			$sql .= " ORDER BY $order";
		
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		foreach ($data as $key => $value )
		{
			$sqlgetitem = "SELECT 
					i.Name as Name 
				FROM 
					s_items i,s_shop_item si, s_itemshop ish 
				WHERE 
					ish.ID = si.ItemID 
				AND 
					(ish.Entity = i.ID OR ish.Item = i.ID)
				AND si.ShopID = ".$value->ID; 
			$arritem = $this->_db->fetchAll($sqlgetitem, "", Zend_Db::FETCH_OBJ);	
			$data[$key]->arrItem = $arritem;
		}
		return $data;		
	}
	
	public function getItemshop($id)
	{
		$sql = "SELECT 
					i.Name as Name, ish.ID as ID, si.ID as IDSI, si.ShopID as ShopID
				FROM 
					s_items i,s_shop_item si, s_itemshop ish 
				WHERE 
					ish.ID = si.ItemID 
				AND 
					(ish.Entity = i.ID OR ish.Item = i.ID)
				AND si.ShopID = ".$id." ORDER BY si.ID"; 
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	
	public function getItemshopByid($id)
	{
		$sql = "SELECT
					ish.*,i.Name,tk.`Name` AS KindName
				FROM
					s_items i,s_itemshop ish,s_type_kind tk
				WHERE
					(ish.Entity = i.ID OR ish.Item = i.ID)
				AND
					tk.ID = ish.Kind
				AND 
					ish.ID = {$id}";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		$sqlgetrequire = "	SELECT 
							tr.`Name`,ir.`Value`
						FROM
							s_itemshop_require ir, s_type_require tr
						WHERE
							ir.TypeRequire = tr.ID
						AND
							ir.ItemShopID = {$data[0]->ID}";
		$require = $this->_db->fetchAll($sqlgetrequire, "", Zend_Db::FETCH_OBJ);
		$data[0]->require = $require;
		
		$sqlgetunblock = "	SELECT 
							iu.`Value`,tu.`Name`
						FROM
							s_itemshop_unblock iu, s_type_unblock tu
						WHERE
							iu.TypeUnblockID = tu.ID
						AND
							iu.ItemShopID = {$data[0]->ID}";
		$unblock = $this->_db->fetchAll($sqlgetunblock, "", Zend_Db::FETCH_OBJ);
		$data[0]->unblock = $unblock;
		
		$sqlgetitemlist = "	SELECT
							ih.`ID`,i.`Name`
						FROM
							s_itemshop ih, s_items i
						WHERE
							(ih.Entity = i.ID OR ih.Item = i.ID)";
		$listitem = $this->_db->fetchAll($sqlgetitemlist, "", Zend_Db::FETCH_OBJ);
		$data[0]->listitem = $listitem;
		
		return $data;
	}
	public function editshopitem($id,$iditem)
	{
		$sql ="	UPDATE
					s_shop_item
				SET 
					ItemID = {$iditem}
				WHERE
					ID = {$id}";
		$this->_db->query($sql);
	}
	public function deleteshopitem($id)
	{
		$sql ="	DELETE FROM
					s_shop_item
				WHERE
					ID = {$id}";
		$this->_db->query($sql);
	}
	public function getlistitemshop()
	{
		$sqlgetitemlist = "	SELECT
								ih.`ID`,i.`Name`
							FROM
								s_itemshop ih, s_items i
							WHERE
								(ih.Entity = i.ID OR ih.Item = i.ID)";
		$listitem = $this->_db->fetchAll($sqlgetitemlist, "", Zend_Db::FETCH_OBJ);
		return $listitem;
	}
	public function newshopitem($iditem,$idshop)
	{
		$sql ="	INSERT INTO 
					s_shop_item 
					(ShopID,itemID) 
				VALUES 
					({$idshop},{$iditem});";
		$this->_db->query($sql);
		
		$sqlGetid = "SELECT MAX(ID) FROM s_shop_item";
		$id = $this->_db->fetchOne($sqlGetid, "", Zend_Db::FETCH_OBJ);
		return $id;
	}
}
?>
