<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Item_Shop extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_itemshop";	
	}
	
	public function getItemShop()
	{
		$sql = "select x.ID as I, y.Entity as E, x.Item as Item,x.K as K,x.Icon,x.Level
				From
				(select a.ID, b.Name as Item,a.Kind,a.Icon,a.Level,s_type_kind.Name as K
				from s_itemshop a left join s_items b on a.Item = b.ID , s_type_kind where s_type_kind.ID=a.Kind) x,
				(select s.ID, c.Name as Entity
				from s_itemshop s left join s_items c on s.Entity = c.ID) y
				where x.ID = y.ID
				ORDER BY x.ID ASC
					";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
			
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "select x.ID as I, y.Entity as E, x.Item as Item,x.K as K,x.Icon,x.Level
				From
				(select a.ID, b.Name as Item,a.Kind,a.Icon,a.Level,s_type_kind.Name as K
				from s_itemshop a left join s_items b on a.Item = b.ID , s_type_kind where s_type_kind.ID=a.Kind) x,
				(select s.ID, c.Name as Entity
				from s_itemshop s left join s_items c on s.Entity = c.ID) y
				where x.ID = y.ID
					";
		
		if($objSearch->ID)
			$sql .= " AND x.ID = '$objSearch->ID'";						
		if($order)
			$sql .= " ORDER BY x.ID ASC";
		
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;		
	}
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					s_itemshop
				WHERE
					1";
		
		if($objSearch->ID)
			$sql .= " AND ID = '$objSearch->ID'";		
		
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public function delete($id)
	{
		parent::_delete($id,null);
		
	}
	public function update($id)
	{
		parent::_update($id,null);
	}
	public function getKind()
	{
		$sql="
			SELECT 
				*
			FROM
				s_type_kind 
		";
		$result=$this->_db->fetchAll($sql);
		return $result;
	}
	public function getRequire()
	{
		$sql="
			SELECT 
				* 
			FROM
				s_type_require
		";		
		$result=$this->_db->fetchAll($sql);
		return $result;
	}
	public function getUnblock()
	{
		$sql="
			SELECT 
				* 
			FROM
				s_type_unblock
		";		
		$result=$this->_db->fetchAll($sql);
		return $result;
	}
	public function getItem()
	{
			$sql="
			SELECT 
				* 
			FROM
				s_items
		";		
		$result=$this->_db->fetchAll($sql);
		return $result;
	}
	public function getMaxId()
	{
		$sql="
			SELECT MAX(ID)+1
			FROM 
				s_itemshop
		";
		$result=$this->_db->fetchOne($sql);
		return $result;
	}
	public function insert($obj)
	{
		parent::_insert($obj);
	}
	 public function getItemShopById($id)
	 {
	 	$sql="
	 		select x.ID as I, y.Entity as E, x.Item as Item,x.K as K,x.Icon,x.Level
				From
				(select a.ID, b.Name as Item,a.Kind,a.Icon,a.Level,s_type_kind.Name as K
				from s_itemshop a left join s_items b on a.Item = b.ID , s_type_kind where s_type_kind.ID=a.Kind) x,
				(select s.ID, c.Name as Entity
				from s_itemshop s left join s_items c on s.Entity = c.ID) y
				where x.ID = y.ID
			 and x.ID=$id
	 	";
	 	$result=$this->_db->fetchOne($sql);
	 	return $result;
	 }
	 public function getRequireByID($id)
	 {
	 	$sql="SELECT 
	 			*
	 		  FROM 
	 			s_itemshop_require  R,s_type_require TR
	 		  WHERE 
				R.TypeRequire=TR.ID and R.ItemShopID={$id} 
			ORDER BY R.ID ASC 		
	 	";
	 	$result=$this->_db->fetchAll($sql);
	 	return $result;
	 }
	 public function getUnblockById($id)
	 {
	 	$sql="SELECT 
	 			*
	 		  FROM 
	 			s_itemshop_unblock,s_type_unblock
	 		  WHERE 
				s_itemshop_unblock.TypeUnblockID=s_type_unblock.ID and s_itemshop_unblock.ItemShopID=$id
			ORDER BY s_itemshop_unblock.ID ASC		
	 	
	 	";
	 	$result=$this->_db->fetchAll($sql);
	 	return $result;
	 }
}
?>
