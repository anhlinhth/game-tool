<?php
require_once ROOT_APPLICATION_MODELS.DS."Item.php";

class ItemManager
{
	private static $instance;

	public static function GetInstance()
	{
		if(!isset(self::$instance))
		{
			return self::$instance = new ItemManager();
		}
		return self::$instance;
	}

	private function __construct()
	{
	}

	public function __destruct()
	{
	}
	
	public function LoadAllFromXML($xmlDoc)
	{
	    $items = array();
		$nodes = $xmlDoc->getElementsByTagName('item');
		foreach($nodes as $node)
		{
			$item = new Item();
			$item->LoadItem($xmlDoc, $node);
			array_push($items, $item);
		}
        return $items;
	}
	
	public function LoadFromXML($xmlDoc, $start, $end)
	{
		$items = array();
		$nodes = $xmlDoc->getElementsByTagName('item');
		if($start < 0)
		{
			$start = 0;
		}
		if($end >= $nodes->length)
		{
			$end = $nodes->length - 1;
		}
        for($i = $start; $i <= $end; $i++)
		{
			$item = new Item();
			$item->LoadItem($xmlDoc, $nodes->item($i));
			array_push($items, $item);
		}
        return $items;
	}

    public function GetLenght($xmlDoc)
    {
        $nodes = $xmlDoc->getElementsByTagName('item');
        return $nodes->length;
    }
    
    public function AddItem($xmlDoc, $item)
	{
		$newNode = $xmlDoc->createElement("item");
		$node = $xmlDoc->getElementsByTagName('items')->item(0);
        $nodes = $xmlDoc->getElementsByTagName('item');
        $count = $nodes->length;
        if($count <= 0)
        {
            $newNode->setAttribute("id", 1);
        }
        else
        {
            $newNode->setAttribute("id", $nodes->item($count - 1)->getAttribute('id') + 1);
        }

		$newNode = $node->appendChild($newNode);
        $newNode->setAttribute("type", $item->type);
		$newNode->setAttribute("description", $item->description);
		$newNode->setAttribute("haveDefault", $item->haveDefault);
		$str = $item->name . ';' .
				$item->image . ';' .
				$item->priceInGame . ';' .
				$item->priceOutGame . ';' .
				$item->quantity . ';';
				
		for($i = 0 ; $i < count($item->status); $i++)
		{
			$str .= $item->status[$i] . ",";
		}
		$str = trim($str, ",");
		
		$str .= ";" . $item->currentStatus . ';'  ;
		
		switch ($item->key)
		{
			case 1 :
				$str .= "CHUA_BENH" . ";" ;
				break;
			case 2 :
				$str .= "HOI_SINH" . ";" ;
				break;
			case 3 :
				$str .= "TANG_CAN" . ";" ;
				break;
			case 4 :
				$str .= "GAY_BENH" . ";" ;
				break;
			case 5 :
				$str .= "TI_LE_TANG_CAN" . ";" ;
				break;
			case 6 :
				$str .= "NEN_CHUONG" . ";" ;
				break;
			case 7 :
				$str .= "PHONG_CANH" . ";" ;
				break;
			case 8 :
				$str .= "BAI_CO" . ";" ;
				break;
			case 9 :
				$str .= "ARCH_STYLE" . ";" ;
				break;
			case 10 :
				$str .= "TRANG_TRI_MU" . ";" ;
				break;
			case 11 :
				$str .= "TRANG_TRI_KINH" . ";" ;
				break;
			case 12 :
				$str .= "TRANG_TRI_AO" . ";" ;
				break;
			case 13 :
				$str .= "BO_TRANGTRI" . ";" ;
				break;
			case 14 :
				$str .= "HANG_RAO" . ";" ;
				break;
			case 15 :
				$str .= "CHUONG_HEO" . ";" ;
				break;
			case 16 :
				$str .= "CHUONG_CHO" . ";" ;
				break;
			case 17 :
				$str .= "XUONG_CHE_BIEN" . ";" ;
				break;
			case 18 :
				$str .= "MANG_AN" . ";" ;
				break;
			case 19 :
				$str .= "VOI_TAM" . ";" ;
				break;
		}
		$str .= $item->effect . ";" . $item->level . ";" . $item->limited * 24;		
		
		$newNode->setAttribute("values", $str);
								
		global $pathIMG;
		move_uploaded_file($_FILES['image']['tmp_name'], $pathIMG.$item->image);
	}
	
	public function UpdateItem($xmlDoc, $id, $item)
	{
		$node = $this->LoadElementItemById($xmlDoc, $id);
        $nodeValue = $node->getAttribute('values');
        $arrayValue = explode(";", $nodeValue);    
        $arrayValue[2] = $item->priceInGame;
        $arrayValue[3] = $item->priceOutGame;
		
		//if($item->giftType)
			//$arrayValue[7] = "ITEM_GIFT_PACKAGE";
		
        for( $i = 0; $i < count($arrayValue) ; $i ++ )
        {
            $str .= $arrayValue[$i] . ";" ;
        }
        $str = trim($str, ";");
        $node->setAttribute("values", $str);
        $node->setAttribute("disCount", $item->disCount); 
        $node->setAttribute("new", $item->new);
        $node->setAttribute("enableInShop", $item->enableInShop);
		//$node->setAttribute("giftType", $item->giftType);
		//$node->setAttribute("giftPackage", $item->giftPackage);
	}
	
	public function DeleteItem($xmlDoc, $id)
	{
		$node = $this->LoadElementItemById($xmlDoc, $id);		
		$node->parentNode->removeChild($node);
	}

	public function LoadAllDislayData($xmlDoc)
	{
		$data = array();

		$nodes = $xmlDoc->getElementsByTagName('item');
		foreach($nodes as $node)
		{
			$item = new Item();
			$item->LoadDislayData($node);
			array_push($data, $item);
		}
		return $data;
	}
	
	public function LoadDislayData($xmlDoc, $start, $end)
	{
		$data = array();
		$nodes = $xmlDoc->getElementsByTagName('item');
		if($start < 0)
		{
			$start = 0;
		}
		if($end >= $nodes->length)
		{
			$end = $nodes->length - 1;
		}
		for($i = $start; $i <= $end; $i++)
		{
			$item = new Item();
			$item->LoadDislayData($nodes->item($i));
			array_push($data, $item);
		}
		return $data;
	}
	
	public function LoadItemById($xmlDoc, $id)
    {
        $node = $this->LoadElementItemById($xmlDoc, $id);
        if($node == null)
        	return null;
		$item = new Item();
		$item->LoadItem($xmlDoc,$node);
		return $item;
    }
    
    public function LoadElementItemById($xmlDoc, $id)
	{
		$nodes = $xmlDoc->getElementsByTagName('item');
		for($i = 0; $i < $nodes->length; $i ++)
        {
            if($nodes->item($i)->getAttribute('id') == $id)
            {
                return $nodes->item($i);
            }
        }
		return null;
	}
	
	public function LoadItemByIndex($xmlDoc, $index)
	{
		$node = $xmlDoc->getElementsByTagName('item')->item($index);
		$item = new Item();
		$item->LoadItem($xmlDoc,$node);
		return $item;
	}
	
	public function ExportToPHP($xmlDoc)
	{
		$items = $this->LoadAllFromXML($xmlDoc);
		$str = "";
		$str .= "<?php
return array(";

		for($i = 0; $i < count($items); $i++)
		{
			$str .= $items[$i]->ToString();
		}

		$str .= "\n\n);
?>";

		$fp = fopen(ITEM_PHP, 'w');
		if(fwrite($fp, $str) !== FALSE)
		{
			return true;
		}
		fclose($fp);
		return false;
	}
	
	public function ExportToFileText($xmlDoc)
    {
    	$items = $this->LoadAllFromXML($xmlDoc);
		for($i = 0; $i < count($items); $i++)
		{
			
			$str .= $items[$i]->type . "|#" . $items[$i]->id . "|#" . $items[$i]->name . "+";
			
			if($items[$i]->priceInGame != 0)
			{
				$str .= "V";
			}
			
			if($items[$i]->priceOutGame != 0)
			{
				$str .= "X";
			}
			
			$str .= "|#NULL\r\n";

			//$str .= $items[$i]->type . "," . $items[$i]->id . "," . $items[$i]->name ;
//			$str .= "\r\n";
		}
		$fp = fopen(ROOT_MEDIA_LOCALDATA_CONFIG.DS.'export_new.txt', 'a');
		if(fwrite($fp, $str) !== FALSE)
		{
			return true;
		}
		fclose($fp);
		return false;
    }
    
    
  	public function Search($xmlDoc, $name, $type, $start, $end, &$totalRecord = 0)
    {
        $nodes = $this->LoadAllFromXML($xmlDoc);
    	if($start < 0)
 		{
 			$start = 0;
  		}
  		if($end >= count($nodes))
 		{
  			$end = count($nodes) - 1;
  		}

        if( $name != "" )
        {
            $name = mb_strtolower($name);         
        }
		
		$items = array();
		$item = new Item();
		for($i = 0; $i < count($nodes); $i ++)
		{
			if($name != "" && $type == 0)
			{                         
				$attName = mb_strtolower($nodes[$i]->name);   
				if(mb_strpos($attName, $name) !== false)
				{                    
					$item = $this->LoadItemByIndex($xmlDoc, $i);                 
					array_push($items,$item);
				}
			}
			else
			{
				if($name == "" && $type != 0)
				{
                    if( $type == $nodes[$i]->type )
                    {
                        $item = $this->LoadItemByIndex($xmlDoc, $i);                 
                        array_push($items,$item);
                    }					
				}
				else
				{
					if($name != "" && $type != 0)
					{
						$attName = mb_strtolower($nodes[$i]->name);
						//$attType = mb_strtolower($nodes[$i]->type);
						if(($nodes[$i]->type  == $type)  && (mb_strpos($attName, $name) !== false))
	     				{                    
					        $item = $this->LoadItemByIndex($xmlDoc, $i);                 
					        array_push($items,$item);
	    				}
					}
				}
			}                                              
		}
		
		$totalRecord = count($items);
		
		return array_splice($items,$start, $end-$start + 1);
	}
	
	public function GetItem_In_ItemSet($xmlDoc)
	{
		$data1 = array();
		$data2 = array();
		$data3 = array();
		$data4 = array();
		$data5 = array();
		$data6 = array();
		$items = $this->LoadAllFromXML($xmlDoc);
		for($i = 0; $i < count($items); $i ++)
		{
			if($items[$i]->key == "BO_TRANGTRI")
			{
				array_push($data1, $items[$i]);
			}
			
			if($items[$i]->key == "CHUONG_HEO")
			{
				array_push($data2, $items[$i]);
			}
			
			if($items[$i]->key == "CHUONG_CHO")
			{
				array_push($data3, $items[$i]);
			}
			
			if($items[$i]->key == "XUONG_CHE_BIEN")
			{
				array_push($data4, $items[$i]);
			}
			
			if($items[$i]->key == "MANG_AN")
			{
				array_push($data5, $items[$i]);
			}
			
			if($items[$i]->key == "VOI_TAM")
			{
				array_push($data6, $items[$i]);
			}
		}
		
		$arrs = array($data1, $data2, $data3, $data4, $data5, $data6);
		return $arrs;
	}
	
	public function LoadItemByGroupId($xmlDoc, $idArr)
	{
		$items = array();
    	$data = explode($idArr, ",");
    	for($i = 0 ; $i < count($data) ; $i ++)
    	{
    		$item = new Item();
    		$item = $this->LoadItemById($xmlDoc, $data[$i]);
    		array_push($items, $item);
    	}
    	return $items;
	}
	
	public function SelectItemByType($xmlDoc, $type)
	{
		$items = array();
		$nodes = $xmlDoc->getElementsByTagName('item');
		for($i = 0 ; $i < $nodes->length; $i ++)
		{
			$item = $this->LoadItemById($xmlDoc, $nodes->item($i)->getAttribute('id'));
			if($item->type == $type)
			{
				array_push($items, $item);
			}
		}
		return $items;
	}
	
	public function SelectItem($xmlDoc)
	{
		$items = $this->SelectItemByType($xmlDoc, 4);
	}
	
	public function SelectFood($xmlDoc)
	{
		$items = $this->SelectItemByType($xmlDoc, 1);
	}
	
	public function SelectDrug($xmlDoc)
	{
		$items = $this->SelectItemByType($xmlDoc, 3);
	}
	
	public function SelectItemByKey($xmlDoc, $key)
	{
		$ids = array();
		$items = $this->LoadAllFromXML($xmlDoc);
		for($i = 0; $i < count($items); $i ++)
		{
			if($items[$i]->key == $key)
			{
				array_push($ids, $items[$i]->id);
			}
		}
		return $ids;
	}
	
	public function SelectMu($xmlDoc)
	{
		return $this->SelectItemByKey($xmlDoc, "TRANG_TRI_MU");
	}
     
	public function SelectAo($xmlDoc)
	{
		return $this->SelectItemByKey($xmlDoc, "TRANG_TRI_AO");
	} 
	
	public function SelectKinh($xmlDoc)
	{
		return $this->SelectItemByKey($xmlDoc, "TRANG_TRI_KINH");
	}
    
    public function ItemInShop($xmlDoc, $start, $end, &$totalRecord = 0)
    {
        $nodes = $this->LoadAllFromXML($xmlDoc);    
        
        if($start < 0)
        {
            $start = 0;
        }
        if($end >= count($nodes))
        {
            $end = count($nodes) - 1;
        }

        $items = array();
        $item = new Item();
        for($i = 0; $i < count($nodes); $i ++)
        {
            if( $nodes[$i]->enableInShop == "true" )
            {
                $item = $this->LoadItemByIndex($xmlDoc, $i);
                    //fireLog($pig);                    
                array_push($items,$item);    
            }                                    
        }
        
        $totalRecord = count($items);
        
        return array_splice($items,$start, $end-$start + 1);
    }
    
    /**
    * Search item by description
    * 
    * @param mixed $xmlDoc
    * @package mixed $type
    * @param mixed $desc
    * @author KietMA
    */
    public function SearchByDesc($xmlDoc, $type, $desc)
    {
        $nodes = $this->LoadAllFromXML($xmlDoc);
        $len = count($nodes);
        $items = array();
        $desc = mb_strtolower($desc, AppConstant::CHAR_SET_UTF8);


        if($this->dislayData[$i]->type == 3 || $this->dislayData[$i]->type == 1) // Thuoc, thuc an
            $str = AppConstant::GIFT_TYPE_GROUPITEM;
        if($this->dislayData[$i]->type == 4 || $this->dislayData[$i]->type == 2 || $this->dislayData[$i]->type == 8) // Ngoai canh, trang bi, goi qua
            $str = AppConstant::GIFT_TYPE_ITEM;
        // Search from XML
        for($i = 0; $i < $len; $i ++)
        {
            $isReturn = false;
            $attName = mb_strtolower($nodes[$i]->name, AppConstant::CHAR_SET_UTF8);
            if ($desc == '')
            {
                if ($type == AppConstant::GIFT_TYPE_GROUPITEM && ($nodes[$i]->type == 3 || $nodes[$i]->type == 1))
                {
                    // GroupItem
                    $isReturn = true;
                }
                else if ($type == AppConstant::GIFT_TYPE_ITEM && ($nodes[$i]->type == 4 || $nodes[$i]->type == 2 || $nodes[$i]->type == 8))
                {
                    // GroupItem
                    $isReturn = true;
                }
            }
            else if((mb_strpos($attName, $desc)  !== false))
            {
                if ($type == AppConstant::GIFT_TYPE_GROUPITEM && ($nodes[$i]->type == 3 || $nodes[$i]->type == 1))
                {
                    // GroupItem
                    $isReturn = true;
                }
                else if ($type == AppConstant::GIFT_TYPE_ITEM && ($nodes[$i]->type == 4 || $nodes[$i]->type == 2 || $nodes[$i]->type == 8))
                {
                    // GroupItem
                    $isReturn = true;
                }
            }
            
            if ($isReturn){
                $item = $this->LoadItemByIndex($xmlDoc, $i);
                array_push($items,$item);
            }
        }
        
        // Search ItemTool.php
        $itemsTool = require_once(ROOT_XML.DS.'ItemTool.php');
        foreach($itemsTool as $item)
        {
            $isReturn = false;
            $attName = mb_strtolower($item['name'], AppConstant::CHAR_SET_UTF8);
            if ($desc == '')
            {
                if ($type == AppConstant::GIFT_TYPE_GROUPITEM && ($item['type'] == 3 || $item['type'] == 1 || $item['type'] == 6))
                {
                    // GroupItem
                    $isReturn = true;
                }
                else if ($type == AppConstant::GIFT_TYPE_ITEM && ($item['type'] == 4 || $item['type'] == 2 || $item['type'] == 8))
                {
                    // GroupItem
                    $isReturn = true;
                }
            }
            else if((mb_strpos($attName, $desc)  !== false))
            {
                if ($type == AppConstant::GIFT_TYPE_GROUPITEM && ($item['type'] == 3 || $item['type'] == 1 || $item['type'] == 6))
                {
                    // GroupItem
                    $isReturn = true;
                }
                else if ($type == AppConstant::GIFT_TYPE_ITEM && ($item['type'] == 4 || $item['type'] == 2 || $item['type'] == 8))
                {
                    // GroupItem
                    $isReturn = true;
                }
            }
            
            if ($isReturn){
                array_push($items,$item);
            }
        }
        
        return $items;        
    }
}
?>
