<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_S_ibshop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Ib_Shop extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_ibshop";	
	}
	
	public function getibshopByID($id)
	{
		$sql="	SELECT *
				FROM 
					s_ibshop
				WHERE
					ID = {$id}";
		$result=$this->_db->fetchrow($sql);
		
		$sql="	SELECT 
					ish.ID itemshopID , i.`Name` Name, ibi.ID ID
				FROM 
					s_ibshop_item ibi, s_items i , s_itemshop ish
				WHERE 
					ibi.ItemID = ish.ID AND (ish.Item = i.ID OR ish.Entity = i.ID)AND ibi.IbShopID =".$result['ID']." ORDER BY ish.ID";
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		$result['arritem'] = $data;
		return $result;
	}
	
	public function getTab($ID)
	{
		$sql="SELECT TabIndex FROM s_ibshop WHERE ID = $ID";
		
		$data = $this->_db->fetchOne($sql);
		return $data;
	}

	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					s_ibshop
				WHERE
					1
				 
					";
		
		if($objSearch->ID)
			$sql .= " AND ID = '$objSearch->ID'";						
		if($order)
			$sql .= " ORDER BY $order";
		
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		foreach ($data as $key => $value )
		{
			$sqlitem="SELECT
						s_ibshop.ID id,s_ibshop.`Name` name,s_ibshop.TabIndex tabindex ,s_ibshop.Title title,s_items.`Name` itemname
					FROM 
						s_ibshop LEFT JOIN s_ibshop_item ON(s_ibshop.ID= s_ibshop_item.IbShopID)  LEFT JOIN s_itemshop ON(s_ibshop_item.ItemID=s_itemshop.ID ) LEFT JOIN s_items
					On s_itemshop.Item=s_items.ID	
					WHERE s_ibshop.ID=$value->ID			
					";
				$arritem = $this->_db->fetchAll($sqlitem, "", Zend_Db::FETCH_OBJ);	
				$data[$key]->arrItem = $arritem;
		}
		return $data;
	}
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					s_ibshop
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
	public function getTabIndex()
	{
		$sql="
			SELECT 
				*
			FROM
				s_ibshop
			
				ORDER BY TabIndex ASC 
				
				";
		$result=$this->_db->fetchAll($sql);
		return $result;
	}
	public function updateIndex($count,$id)
	{		
		$sql="
			UPDATE 
				s_ibshop
			SET 
				TabIndex=$count
			WHERE 
				ID=$id;
		";
		$this->_db->query($sql);			
	}
}
?>