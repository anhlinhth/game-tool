<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Item extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "item";		
	}
	
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					item
				WHERE
					1";
		
		if($objSearch->id)
			$sql .= " AND id = '$objSearch->id'";
		if($objSearch->name)
			$sql .= " AND name LIKE '%$objSearch->name%'";
		if($objSearch->type)
			$sql .= " AND type = '$objSearch->type'";
		if($objSearch->enableInShop == 1)
			$sql .= " AND enableInShop = 1";
		elseif($objSearch->enableInShop == 2)
			$sql .= " AND enableInShop <> 1";
		if($objSearch->priceInGameFrom)
			$sql .= " AND priceInGame >= '$objSearch->priceInGameFrom'";
		if($objSearch->priceInGameTo)
			$sql .= " AND priceInGame <= '$objSearch->priceInGameTo'";
		if($objSearch->priceOutGameFrom)
			$sql .= " AND priceOutGame >= '$objSearch->priceOutGameFrom'";
		if($objSearch->priceOutGameTo)
			$sql .= " AND priceOutGame <= '$objSearch->priceOutGameTo'";
		if($objSearch->effect)	
			$sql .= " AND effect = '$objSearch->effect'";
		
		if($order)
			$sql .= " ORDER BY '$order'";
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		
		$data = $this->_db->fetchAll($sql, "", Zend_DB::FETCH_OBJ);
		
		return $data;
	}
	
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(id)
				FROM
					item
				WHERE
					1";
		
		if($objSearch->id)
			$sql .= " AND id = '$objSearch->id'";
		if($objSearch->name)
			$sql .= " AND name LIKE '%$objSearch->name%'";
		if($objSearch->type)
			$sql .= " AND type = '$objSearch->type'";
		if($objSearch->enableInShop == 1)
			$sql .= " AND enableInShop = 1";
		elseif($objSearch->enableInShop == 2)
			$sql .= " AND enableInShop <> 1";
		if($objSearch->priceInGameFrom)
			$sql .= " AND priceInGame >= '$objSearch->priceInGameFrom'";
		if($objSearch->priceInGameTo)
			$sql .= " AND priceInGame <= '$objSearch->priceInGameTo'";
		if($objSearch->priceOutGameFrom)
			$sql .= " AND priceOutGame >= '$objSearch->priceOutGameFrom'";
		if($objSearch->priceOutGameTo)
			$sql .= " AND priceOutGame <= '$objSearch->priceOutGameTo'";
		
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	
	public function setStatus($id, $status)
	{
		$sql = "UPDATE
					item
				SET
					enableInShop = '$status'
				WHERE
					id = '$id'";
		
		$this->_db->query($sql);
	}
	
	public static function generateItem($data, $location)
	{
		$str .= "<?php\nreturn array(";		
		if($data)
		{
			foreach($data as $row)
			{
				if($location == DEV)
					$url = URL_IMAGE_ITEMGIFT_DEV.DS.$row->image;
				else
					$url = URL_IMAGE_ITEMGIFT_LIVE.DS.$row->image;
				
				$str .= "\n\t'$row->id' => array(";				
				$str .= "\n\t\t'id' => '$row->id',";
				$str .= "\n\t\t'type' => '$row->type',";
				$str .= "\n\t\t'description' => '$row->description',";
				$str .= "\n\t\t'name' => '$row->name',";
				$str .= "\n\t\t'haveDefault' => '$row->haveDefault',";
				$str .= "\n\t\t'image' => '$row->image',";
				$str .= "\n\t\t'priceInGame' => '".(int)$row->priceInGame."',";
				$str .= "\n\t\t'priceOutGame' => '".(int)$row->priceOutGame."',";
				$str .= "\n\t\t'quantity' => '".(int)$row->quantity."',";
				$str .= "\n\t\t'status' => '".(int)$row->status."',";
				$str .= "\n\t\t'currentStatus' => '".(int)$row->currentStatus."',";
				$str .= "\n\t\t'key' => '$row->key',";
				$str .= "\n\t\t'effect' => array('$row->key'=>'$row->effect'),";
				$str .= "\n\t\t'level' => '".(int)$row->level."',";
				$str .= "\n\t\t'limited' => '".(int)$row->limited."',";
				$str .= "\n\t\t'useAtHome' => '".(int)$row->useAtHome."',";
				$str .= "\n\t\t'maxLevel' => '".(int)$row->maxLevel."',";
				$str .= "\n\t\t'exp' => '".(int)$row->exp."',";
				$str .= "\n\t\t'refineLevel' => '".(int)$row->refineLevel."',";
				$str .= "\n\t\t'expiredCoin' => '".(int)$row->expiredCoin."',";
				$str .= "\n\t\t'disCount' => '".(int)$row->disCount."',";
				if($row->enableInShop)
					$row->enableInShop = "true";
				else
					$row->enableInShop = "false";
				$str .= "\n\t\t'enableInShop' => ".$row->enableInShop.",";	
				$str .= "\n\t\t'url' => '".$url."',";
				$str .= "\n\t\t'basePriceInGame' => '".(int)$row->basePriceInGame."',";
				$str .= "\n\t\t'basePriceOutGame' => '".(int)$row->basePriceOutGame."'),";
			}
		}
		
		$str .= "\n\n);\n?>";		
		
		$fp = fopen(ITEM_TOOL_PHP_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
        
        copy(ITEM_TOOL_PHP_FILE,ROOT_XML.DS.'ItemTool.php');
        
		return true;
	}
	
	public function sync($items, $saleOffShop,$location)
	{
		$checkItem			= Models_Item::generateItem($items,$location);
		$checkSaleOff		= Models_SaleOff_Shop::generateSaleOffShop($saleOffShop);
		
		if($checkItem && $checkSaleOff)
		{
			//Backup
			$date = date('Ymd_His');
			if($location == DEV)
			{
				$newDir = FTP_CONFIG_PATH_DEV.$date.DS;
				
				$item = FTP_CONFIG_PATH_DEV.'ItemTool.php';				
				$saleOff = FTP_CONFIG_PATH_DEV.'GiftSaleOff.php';
				
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mkdir '. $newDir .'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mv '. $item. ' '. $saleOff. ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();
			}
			else if($location == LIVE)
			{
				$item = FTP_CONFIG_PATH_LIVE.'ItemTool.php';				
				$saleOff = FTP_CONFIG_PATH_LIVE.'GiftSaleOff.php';
				
				$newDir = FTP_CONFIG_PATH_LIVE.$date.DS;
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_LIVE .'" "mkdir '.$newDir.'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_LIVE .'" "mv '. $item. ' '. $saleOff. ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();				
			}
			//
			
			Utility::syncData($location);
			Utility::syncItemGiftImage($location);
		}
	}
}
?>
