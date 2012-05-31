<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';

class Models_Gift_Package extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "gift_package";		
	}
	
	public function insert($obj)
	{
		$id = $this->isExist($obj->alias);
		if($id)
			throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID,"Gói phần thưởng đã tồn tại");
		
		if($obj->start_date)
		{
			$arrDate = array();
			$arrDate = explode("/", $obj->start_date);
			$obj->start_date = $arrDate[2]."/".$arrDate[0]."/".$arrDate[1];
		}
		
		if($obj->end_date)
		{
			$arrDate = array();
			$arrDate = explode("/", $obj->end_date);
			$obj->end_date = $arrDate[2]."/".$arrDate[0]."/".$arrDate[1];
		}
		
		parent::_insert($obj);
	}
	
	public function update($obj)
	{
		$id = $this->isExist($obj->alias);
		if($id != $obj->id && !empty ($id))
			throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID,"Gói phần thưởng đã tồn tại");
		
		if($obj->start_date)
		{
			$arrDate = array();
			$arrDate = explode("/", $obj->start_date);
			$obj->start_date = $arrDate[2]."/".$arrDate[0]."/".$arrDate[1];
		}
		else
			$obj->start_date = null;
		
		if($obj->end_date)
		{
			$arrDate = array();
			$arrDate = explode("/", $obj->end_date);
			$obj->end_date = $arrDate[2]."/".$arrDate[0]."/".$arrDate[1];
		}
		else
			$obj->end_date = null;
		
		parent::_update($obj);
	}
	
	private function isExist($alias)
	{
		$sql = "SELECT
					id
				FROM
					gift_package
				WHERE
					alias = '$alias'";
		
		$id = $this->_db->fetchOne($sql);
		
		return $id;
	}
	
	public function setStatus($id,$status)
	{
		$sql = "UPDATE 
					gift_package
				SET 
					enabled = '$status'
				WHERE
					id = '$id'";
		
		$this->_db->query($sql);
	}
	
	public function getGiftType()
	{
		$sql = "SELECT
					*
				FROM
					gift_type";
		
		$data = $this->_db->fetchAll($sql);
		
		return $data;
	}
	
	public function generate($data)
	{
		$str .= "<?php\nreturn array(";
		$mdGiftPackageDetail = new Models_Gift_Package_Detail();
		if($data)
		{
			$i = 1;
			foreach($data as $row)
			{
				if($row->start_date)
					$strStartDate = strtotime($row->start_date);
				else
					$strStartDate = "";
				
				if($row->end_date)
					$strEndDate = strtotime($row->end_date);
				else
					$strEndDate = "";
				
				$str .= "\n\t'$row->alias' => array(";				
				$str .= "\n\t\t'name' => '$row->name',";
				$str .= "\n\t\t'desc' => '$row->description',";
				$str .= "\n\t\t'status' => '". (int)$row->enabled ."',";
				$str .= "\n\t\t'start_date' => '". $strStartDate ."',";
				$str .= "\n\t\t'end_date' => '". $strEndDate ."',";
				$str .= "\n\t\t'userLimit' => '". $row->user_limit ."',";
				$str .= "\n\t\t'serverLimit' => '". $row->server_limit ."',";
				$str .= "\n\t\t'tag' => '". $row->tag ."',";
				$str .= "\n\t\t'gift' => array(";
				
				$objSearch->gift_package_id = $row->id;
				$gifts = $mdGiftPackageDetail->_filter($objSearch);
				
				if($gifts)
				{
					foreach($gifts as $gift)
					{
						$str .= "\n\t\t\t\tarray(";
						$str .= "'type' => '$gift->type',";
						$str .= "'id' => array('$gift->object_id'),";
						$str .= "'qty' => ". (int)$gift->quantity .",";
						$str .= "'rank' => ". (int)$gift->rank ."),";
					}
				}
				
				$str .= "\n\t\t\t)";
				
				$str .= "\n\t\t),";
				
				$i++;
			}
		}
		
		$str .= "\n\n);\n?>";		
		
		$fp = fopen(GIFT_PACKAGE_PHP_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		return true;
	}
	
	
	
	public function sync($data,$itemData,$saleOffShopData,$location)
	{
		$checkGiftPackage	= $this->generate($data);
		$checkItem			= Models_Item::generateItem($itemData,$location);
		$checkSaleOff		= Models_SaleOff_Shop::generateSaleOffShop($saleOffShopData);
		
		if($checkGiftPackage && $checkItem && $checkSaleOff)
		{
			//Backup
			$date = date('Ymd_His');
			if($location == DEV)
			{
				$newDir = FTP_CONFIG_PATH_DEV.$date.DS;
				
				$item = FTP_CONFIG_PATH_DEV.'ItemTool.php';
				$giftPackage = FTP_CONFIG_PATH_DEV.'GiftPackageTool.php';
				$saleOff = FTP_CONFIG_PATH_DEV.'GiftSaleOff.php';
				
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mkdir '. $newDir .'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mv '. $item. ' '. $giftPackage . ' ' . $saleOff. ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();
			}
			else if($location == LIVE)
			{
				$item = FTP_CONFIG_PATH_LIVE.'ItemTool.php';
				$giftPackage = FTP_CONFIG_PATH_LIVE.'GiftPackageTool.php';
				$saleOff = FTP_CONFIG_PATH_LIVE.'GiftSaleOff.php';
				
				$newDir = FTP_CONFIG_PATH_LIVE.$date.DS;
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_LIVE .'" "mkdir '.$newDir.'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_LIVE .'" "mv '. $item. ' '. $giftPackage . ' ' . $saleOff. ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();				
			}			
			
			Utility::syncData($location);
			Utility::syncItemGiftImage($location);
		}
	}
		
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					gift_package
				WHERE
					1";
		
		if($objSearch->alias)
			$sql .= " AND alias LIKE '%$objSearch->alias%'";
		
		if($objSearch->type)
			$sql .= " AND type = '$objSearch->type'";
		
		if($objSearch->event_id)
			$sql .= " AND event_id = '$objSearch->event_id'";
		
		if($order)
			$sql .= " ORDER BY $order";
		
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;		
	}
	
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(id)
				FROM
					gift_package
				WHERE
					1";
		
		if($objSearch->alias)
			$sql .= " AND alias LIKE '%$objSearch->alias%'";
		
		if($objSearch->type)
			$sql .= " AND type = '$objSearch->type'";
		
		if($objSearch->event_id)
			$sql .= " AND event_id = '$objSearch->event_id'";
		
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
}
?>