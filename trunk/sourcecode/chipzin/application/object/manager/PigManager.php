<?php
require_once ROOT_APPLICATION_MODELS.DS."Pig.php";
//require_once ROOT_APPLICATION_PUBLIC_MODELS.DS."OLERead.php";
//require_once ROOT_APPLICATION_PUBLIC_MODELS.DS."excel_reader2.php";

class PigManager
{
	private static $instance;

	public static function GetInstance()
	{
		if(!isset(self::$instance))
		{
			return self::$instance = new PigManager();
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
	   $pigs = array();
		$nodes = $xmlDoc->getElementsByTagName('pig');
		foreach($nodes as $node)
		{
			$pig = new Pig();
			$pig->LoadPig($xmlDoc, $node);
			array_push($pigs, $pig);
		}
        return $pigs;
	}

	public function LoadFromXML($xmlDoc, $start, $end)
	{
		$pigs = array();
		$nodes = $xmlDoc->getElementsByTagName('pig');
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
			$pig = new Pig();
			$pig->LoadPig($xmlDoc, $nodes->item($i));

			array_push($pigs, $pig);
		}
        return $pigs;
	}

    public function GetLenght($xmlDoc)
    {
        $nodes = $xmlDoc->getElementsByTagName('pig');
        return $nodes->length;
    }

	public function AddPig($xmlDoc, $pig)
	{
		$newNode = $xmlDoc->createElement("pig");
		$node = $xmlDoc->getElementsByTagName('pigs')->item(0);
        $nodes = $xmlDoc->getElementsByTagName('pig');
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
		$newNode->setAttribute("type", $pig->type);
		$newNode->setAttribute("description", $pig->description);
		$newNode->setAttribute("statusInshop", $pig->statusInShop);
		$newNode->setAttribute("name", $pig->name);
		$newNode->setAttribute("shortDes", $pig->shortDesc);
		$newNode->setAttribute("stealPunish", $pig->stealPunish);		
		$newNode->setAttribute("level", $pig->level);
		$newNode->setAttribute("specialPig", $pig->specialPig);
		$pig->lifeCycle *= 24;
		$str = $pig->lifeCycle . ';' .
				$pig->health . ';' .
				$pig->weightGainPerHour . ';' .
				$pig->weightDownPerHour . ';' .
				$pig->priceForOneKg . ';' .
				$pig->weight . ';' .
				$pig->priceInGame . ';' .
				$pig->priceOutGame . ';' .
				$pig->unit . ';' .
				$pig->image . ';' ;
		for($i = 0 ; $i < count($pig->status); $i++)
		{
			$str .= $pig->status[$i] . ",";
		}
		$str = trim($str, ",");
		$str .= ";" . $pig->age ;
		$newNode->setAttribute("values", $str);
		$newNode->setAttribute("begetPrice", $pig->begetPrice);
		$newNode->setAttribute("begetPriceMax", $pig->begetPriceMax);
		$newNode->setAttribute("giftGoldMinHome", $pig->giftGoldMinHome);
		$newNode->setAttribute("giftGoldMaxHome", $pig->giftGoldMaxHome);
		$newNode->setAttribute("giftHonourHome", $pig->giftHonourHome);
		$newNode->setAttribute("giftGoldMinFriend", $pig->giftGoldMinFriend);
		$newNode->setAttribute("giftGoldMaxFriend", $pig->giftGoldMaxFriend);
		$newNode->setAttribute("sellExp", $pig->sellExp);
		
		global $pathImgPig;
		move_uploaded_file($_FILES['image']['tmp_name'], $pathImgPig.$pig->image);
	}

	public function UpdatePig($xmlDoc, $id, $pig)
	{
		$node = $this->LoadElementPigById($xmlDoc, $id);
        $nodeValue = $node->getAttribute('values');
        $arrayValue = explode(";", $nodeValue);    
        $arrayValue[6] = $pig->priceInGame;
        $arrayValue[7] = $pig->priceOutGame;
        for( $i = 0; $i < count($arrayValue) ; $i ++ )
        {
            $str .= $arrayValue[$i] . ";" ;
        }
        $str = trim($str, ";");
        $node->setAttribute("values", $str);
        $node->setAttribute("disCount", $pig->disCount); 
        $node->setAttribute("enableInShop", $pig->enableInShop);
	}

	public function DeletePig($xmlDoc, $id)
	{
		$node = $this->LoadElementPigById($xmlDoc, $id);
		//global $pathIMG;
		//if(file_exists($pathIMG.DS.$node->getAttribute('image')))
		//		unlink($pathIMG.DS.$node->getAttribute('image'));
		$node->parentNode->removeChild($node);
	}

	public function LoadAllDislayData($xmlDoc)
	{
		$data = array();

		$nodes = $xmlDoc->getElementsByTagName('pig');
		foreach($nodes as $node)
		{
			$pig = new Pig();
			$pig->LoadDislayData($node);
			array_push($data, $pig);
		}
		return $data;
	}

	public function LoadDislayData($xmlDoc, $start, $end)
	{
		$data = array();
		$nodes = $xmlDoc->getElementsByTagName('pig');
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
			$pig = new Pig();
			$pig->LoadDislayData($nodes->item($i));
			array_push($data, $pig);
		}
		return $data;
	}

    public function LoadPigById($xmlDoc, $id)
    {
        $node = $this->LoadElementPigById($xmlDoc, $id);
        if($node == null)
        	return null;
		$pig = new Pig();
		$pig->LoadPig($xmlDoc,$node);
		return $pig;
    }
	
	public function LoadPigByType($xmlDoc, $type)
    {
        $node = $this->LoadElementPigByType($xmlDoc, $type);
        if($node == null)
        	return null;
		$pig = new Pig();
		$pig->LoadPig($xmlDoc,$node);
		return $pig;
    }

    public function LoadElementPigById($xmlDoc, $id)
	{
		$nodes = $xmlDoc->getElementsByTagName('pig');
		for($i = 0; $i < $nodes->length; $i ++)
        {
            if($nodes->item($i)->getAttribute('id') == $id)
            {
                return $nodes->item($i);
            }
        }
		return null;
	}
	
	public function LoadElementPigByType($xmlDoc, $type)
	{
		$nodes = $xmlDoc->getElementsByTagName('pig');
		for($i = 0; $i < $nodes->length; $i ++)
        {
            if($nodes->item($i)->getAttribute('type') == $type)
            {
                return $nodes->item($i);
            }
        }
		return null;
	}

	public function LoadPigByIndex($xmlDoc, $index)
	{
		$node = $xmlDoc->getElementsByTagName('pig')->item($index);
		$pig = new Pig();
		$pig->LoadPig($xmlDoc,$node);
		return $pig;
	}
	
	public function ExportType($xmlDoc)
	{
		$pigs = $this->LoadAllFromXML($xmlDoc);

		$str = "";
		for($i = 0; $i < count($pigs); $i++)
		{
			$str .= $pigs[$i]->type . "_" . $pigs[$i]->gender . "\n";
		}

		$fp = fopen(ROOT_MEDIA_LOCALDATA_CONFIG.DS.'PigType.txt', 'w');
		if(fwrite($fp, $str) !== FALSE)
		{
			return true;
		}
		fclose($fp);
		return false;
	}

	public function ExportToPHP($xmlDoc)
	{
		$pigs = $this->LoadAllFromXML($xmlDoc);

		$str = "";
		$str .= "<?php
return array(";

		for($i = 0; $i < count($pigs); $i++)
		{
			$str .= $pigs[$i]->ToString();
		}

		$str .= "\n\n);
?>";

		$fp = fopen(PIG_PHP, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		return true;
	}
	
	public function ExportPigGiftToPHP($xmlDoc)
	{
		$pigs = $this->LoadAllFromXML($xmlDoc);

		$str = "";
		$str .= "<?php
return array(\n\t\t\t";

		for($i = 0; $i < count($pigs); $i++)
		{
			$type = $pigs[$i]->type . "_" . $pigs[$i]->gender;
			$str .= "'{$type}' =>    array('goldMin' => {$pigs[$i]->giftGoldMinHome},'goldMax' => {$pigs[$i]->giftGoldMaxHome},'honour' => {$pigs[$i]->giftHonourHome}),\n\t\t\t";
		}

		$str = trim($str, ",\n\t\t\t");
		$str .= "\n);
?>";

		$fp = fopen(ROOT_MEDIA_LOCALDATA_CONFIG.DS.'PigGift.php', 'w');
		if(fwrite($fp, $str) !== FALSE)
		{
			return true;
		}
		fclose($fp);
		return false;
	}
	
	public function ExportToFileText($xmlDoc)
    {
    	$pigs = $this->LoadAllFromXML($xmlDoc);
    	$str = "";
		for($i = 0; $i < count($pigs); $i++)
		{
			$str .= "5" . "|#" . $pigs[$i]->id . "|#" . $pigs[$i]->name . "+";
			
			if($pigs[$i]->priceInGame != 0)
			{
				$str .= "V";
			}
			
			if($pigs[$i]->priceOutGame != 0)
			{
				$str .= "X";
			}
			
			if($pigs[$i]->gender == 0)
			{
				$str .= "C|#0";
			}
			else
			{
				$str .= "D|#1";
			}
			
			$str .= "\r\n";

				//$str .= $pigs[$i]->id . "," . $pigs[$i]->type . "_" . $pigs[$i]->gender . "," . $pigs[$i]->name ;
//				$str .= "\r\n";	
			
			
			
			
		}
		$fp = fopen(ROOT_MEDIA_LOCALDATA_CONFIG.DS.'export_new.txt', 'w');
		if(fwrite($fp, $str) !== FALSE)
		{
			return true;
		}
		fclose($fp);
		return false;
    }
    
    public function Search($xmlDoc, $name, $gender, $level, $start, $end, &$totalRecord = 0)
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

        $name = mb_strtolower($name);
        $gender = mb_strtolower($gender); 
        $level = mb_strtolower($level);         
        $pigs = array();
        $pig = new Pig();
        for($i = 0; $i < count($nodes); $i ++)
        {
            if($name != "" && $gender == "" && $level == "")
            {            
                $attName = mb_strtolower($nodes[$i]->name);
                if(mb_strpos($attName, $name) !== false)
                {                    
                    $pig = $this->LoadPigByIndex($xmlDoc, $i);
					//fireLog($pig); 
					$pig->type = $pig->type . '_' . $pig->gender ;
                    array_push($pigs,$pig);
                }
            }
            else
                if($name == "" && $gender != "" && $level == "")
                {
                    $attGender = mb_strtolower($nodes[$i]->gender);
                    if(mb_strpos($attGender, $gender) !== false)
                    {
                        //$pig = new Pig();
                        $pig = $this->LoadPigByIndex($xmlDoc, $i);
                        array_push($pigs,$pig);
                    }
                }
                else
                    if($name == "" && $gender == "" && $level != "")
                    {
                        $attLevel = mb_strtolower($nodes[$i]->level);
                        if(mb_strpos($attLevel, $level) !== false)
                        {
                            //$pig = new Pig();
                            $pig = $this->LoadPigByIndex($xmlDoc, $i);
                            array_push($pigs,$pig);
                        }
                    }
                    else
                        if($name != "" && $gender != "" && $level == "")
                        {
                            $attName = mb_strtolower($nodes[$i]->name);
                            $attGender = mb_strtolower($nodes[$i]->gender);
                            if((mb_strpos($attName, $name)  !== false) &&
                                (mb_strpos($attGender, $gender) !== false))
                            {
                                //$pig = new Pig();
                                $pig = $this->LoadPigByIndex($xmlDoc, $i);
                                array_push($pigs,$pig);
                            }
                        }
                        else
                            if($name != "" && $gender == "" && $level != "")
                            {
                                $attName = mb_strtolower($nodes[$i]->name);
                                $attLevel = mb_strtolower($nodes[$i]->level);
                                if((mb_strpos($attName, $name)  !== false) &&
                                    (mb_strpos($attLevel, $level) !== false))
                                {
                                    //$pig = new Pig();
                                    $pig = $this->LoadPigByIndex($xmlDoc, $i);
                                    array_push($pigs,$pig);
                                }
                            }
                            else
                                if($name == "" && $gender != "" && $level != "")
                                {
                                    $attGender = mb_strtolower($nodes[$i]->gender);
                                    $attLevel = mb_strtolower($nodes[$i]->level);
                                    if((mb_strpos($attGender, $gender)  !== false) &&
                                        (mb_strpos($attLevel, $level) !== false))
                                    {
                                        //$pig = new Pig();
                                        $pig = $this->LoadPigByIndex($xmlDoc, $i);
                                        array_push($pigs,$pig);
                                    }
                                }
                                else
                                    if($name != "" && $gender != "" && $level != "")
                                    {
                                        $attName = mb_strtolower($nodes[$i]->name);
                                        $attGender = mb_strtolower($nodes[$i]->gender);
                                        $attLevel = mb_strtolower($nodes[$i]->level);
                                        if((mb_strpos($attName, $name) !== false) &&
                                            (mb_strpos($attGender, $gender) !== false) &&
                                            (mb_strpos($attLevel, $level) !== false))
                                        {
                                            //$pig = new Pig();
                                            $pig = $this->LoadPigByIndex($xmlDoc, $i);
                                            array_push($pigs,$pig);
                                        }
                                    }
                                    
        }
        
        $totalRecord = count($pigs);
        
        return array_splice($pigs,$start, $end-$start + 1);
    }
    
    public function ExportQuestionFromExcel()
    {
    	$data = new Spreadsheet_Excel_Reader();
    	$data->setUTFEncoder('iconv');
    	$data->setOutputEncoding('UTF-8');
    	$data->read(ROOT_MEDIA_LOCALDATA_CONFIG . DS . "CauHoi.xls");    			
    	$str = "";
		$str .= "<?php
return array(\n\t" ;

		for($i = 2; $i <= $data->rowcount(0); $i++)
		{
			$stt = $data->val($i,1);
			$content = $data->val($i,3);
			$answer0 = $data->val($i,4);
			$answer1 = $data->val($i,5);
			$answer2 = $data->val($i,6);
			$answer3 = $data->val($i,7);
			$value = $data->val($i,8);
			
			switch ($value)
			{
				case 0 :
					$isKey0 = "true";
					$isKey1 = "false";
					$isKey2 = "false";
					$isKey3 = "false";
					break;
				case 1 :
					$isKey0 = "false";
					$isKey1 = "true";
					$isKey2 = "false";
					$isKey3 = "false";
					break;
				case 2 :
					$isKey0 = "false";
					$isKey1 = "false";
					$isKey2 = "true";
					$isKey3 = "false";
					break;
				case 3 :
					$isKey0 = "false";
					$isKey1 = "false";
					$isKey2 = "false";
					$isKey3 = "true";
					break;
			}
				$str .= "{$stt} => array(
        'id' => {$stt},
        'content' => '{$content}',
        'answers' => array(
                        array(
                            'ordinal' => 1,
                            'content' => '{$answer0}',
                            'isKey' => {$isKey0}
                        ),
                        array(
                            'ordinal' => 2,
                            'content' => '{$answer1}',
                            'isKey' => {$isKey1}
                        ),
                        array(
                            'ordinal' => 3,
                            'content' => '{$answer2}',
                            'isKey' => {$isKey2}
                        ),
                        array(
                            'ordinal' => 4,
                            'content' => '{$answer3}',
                            'isKey' => {$isKey3}
                        ),
                    )
    )," . "\n\t";			
			
		}
		$str = trim($str, "\n\t,");
		$str .= "\n";

		$str .= ");
?>";
		//$str = utf8_encode($str);
		$fp = fopen(ROOT_MEDIA_LOCALDATA_CONFIG.DS.'Question.php', 'wb');
		fwrite($fp, pack("CCC", 0xef, 0xbb, 0xbf));
		if(fwrite($fp, $str) !== FALSE)
		{
			fclose($fp);
			return true;
		}
		fclose($fp);
		return false;
    }
    
    public function test()
    {
    	$data = new Spreadsheet_Excel_Reader();
    	$data->setUTFEncoder('iconv');
    	$data->setOutputEncoding('UTF-8');
    	$data->read(ROOT_MEDIA_LOCALDATA_CONFIG . DS . "CauHoi_utf8.xls");
    	$fp = fopen(ROOT_MEDIA_LOCALDATA_CONFIG.DS.'test.php', 'wb');
    		//fwrite($fp, pack("CCC", 0xef, 0xbb, 0xbf));
    		$str = "<?php\n";
    		fwrite($fp, $str);
		for($i = 2; $i <= $data->rowcount(0); $i++)
		{
			for($j = 1; $j <= 8; $j++)
			{
				$str = $data->val($i,$j);
	    		//$str = utf8_encode($str);
				$str = "echo ". "'{$str}<br/>';\n";
				fwrite($fp, $str);
				
			}
		}
    	fwrite($fp, "?>");
   
		fclose($fp);
		return false;
    }
    
    public function ExportQuestionFromXml($xmlDoc)
    {
    	$nodes = $xmlDoc->getElementsByTagName('Row');   
		$count = 0; 	
    	$str = "";
		$str .= "<?php
return array(\n\t" ;
		$answer = array("", "", "", "");
    	foreach($nodes as $node)
    	{
    		$isKeyArray = array("false", "false", "false", "false");
    		$childs = $node->getElementsByTagName('STT')->item(0);
    		if($childs != null)    
			{
				$stt = $childs->nodeValue;
				$count ++;
			}		
			else
				 $stt = "";   	
				 	
    		$childs = $node->getElementsByTagName('content')->item(0);
    		if($childs != null)    		
    			$content = $childs->nodeValue;
			else
			{
				 $count --;
				 continue;
			}
    		
    		$childs = $node->getElementsByTagName('answer0')->item(0);
    		if($childs != null)    		
    			$answer[0] = $childs->nodeValue;
			else
			{
				$count --;
				 continue;
			}
    		//$answer[0] = $childs->nodeValue;
    		$childs = $node->getElementsByTagName('answer1')->item(0);
    		if($childs != null)    		
    			$answer[1] = $childs->nodeValue;
			else
			{
				$count --;
				 continue;
			}
    		//$answer[1] = $childs->nodeValue;
    		$childs = $node->getElementsByTagName('answer2')->item(0);
    		if($childs != null)    		
    			$answer[2] = $childs->nodeValue;
			else
			{
				$count --;
				 continue;
			}
    		//$answer[2] = $childs->nodeValue;
    		$childs = $node->getElementsByTagName('answer3')->item(0);
    		if($childs != null)    		
    			$answer[3] = $childs->nodeValue;
			else
			{
				$count --;
				 continue;
			}
    		//$answer[3] = $childs->nodeValue;
    		$childs = $node->getElementsByTagName('isTrue')->item(0);
    		if($childs != null)    		
			{
				$iTrue = $childs->nodeValue;
    			$isKeyArray[$iTrue] = "true";	
			}
			else
			{
				$count --;
				 continue;
			}
    		
    		
    		$str .= "{$count} => array(
        'id' => {$count},
        'content' => '{$content}',
        'answers' => array(
                        array(
                            'ordinal' => 1,
                            'content' => '{$answer[0]}',
                            'key' => {$isKeyArray[0]}
                        ),
                        array(
                            'ordinal' => 2,
                            'content' => '{$answer[1]}',
                            'key' => {$isKeyArray[1]}
                        ),
                        array(
                            'ordinal' => 3,
                            'content' => '{$answer[2]}',
                            'key' => {$isKeyArray[2]}
                        ),
                        array(
                            'ordinal' => 4,
                            'content' => '{$answer[3]}',
                            'key' => {$isKeyArray[3]}
                        ),
                    )
    )," . "\n\t";
    		
    			
    	}
    	
    	$str = trim($str, "\n\t,");
		$str .= "\n";

		$str .= ");
?>";
		//$str = utf8_encode($str);
		$fp = fopen(ROOT_MEDIA_LOCALDATA_CONFIG.DS.'Question.php', 'wb');
		//fwrite($fp, pack("CCC", 0xef, 0xbb, 0xbf));
		if(fwrite($fp, $str) !== FALSE)
		{
			fclose($fp);
			return true;
		}
		fclose($fp);
		return false;
    }
    
    public function LoadPigByGroupId($xmlDoc, $idArr)
    {
    	$pigs = array();
    	$data = explode($idArr, ",");
    	for($i = 0 ; $i < count($data) ; $i ++)
    	{
    		$pig = new Pig();
    		$pig = $this->LoadPigById($xmlDoc, $data[$i]);
    		array_push($pigs, $pig);
    	}
    	return $pigs;
    }
    
    public function SelectPigByPriceOutGame($xmlDoc, $priceMin, $priceMax)
    {
    	$ids = array();
    	$pigs = $this->LoadAllFromXML($xmlDoc);
    	for($i = 0; $i < count($pigs); $i ++)
    	{
    		if($pigs[$i]->priceOutGame > $priceMin && $pigs[$i]->priceOutGame <= $priceMax && $pigs[$i]->specialPig == 1)
    		{
    			if($pigs[$i]->gender == 1)
    				array_push($ids, $pigs[$i]->type . "_1" );
    			else
    				array_push($ids, $pigs[$i]->type . "_0");
    		}
    	}
    	return $ids;
    }
  	
	public function ExportTypeAndIdToFileText($xmlDoc)
    {
    	$pigs = $this->LoadAllFromXML($xmlDoc);
    	$str = "";
		for($i = 0; $i < count($pigs); $i++)
		{
			$str .= $pigs[$i]->id . "|#" . $pigs[$i]->type . "_" . $pigs[$i]->gender . "\n";
		}
		$fp = fopen(ROOT_MEDIA_LOCALDATA_CONFIG.DS.'export_type_id_pig.txt', 'w');
		if(fwrite($fp, $str) !== FALSE)
		{
			return true;
		}
		fclose($fp);
		return false;
    }
    
    public function PigInShop($xmlDoc, $start, $end, &$totalRecord = 0)
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

        $pigs = array();
        $pig = new Pig();
        for($i = 0; $i < count($nodes); $i ++)
        {
            if( $nodes[$i]->enableInShop == "true" )
            {
                $pig = $this->LoadPigByIndex($xmlDoc, $i);
                $pig->type = $pig->type . '_' . $pig->gender ;
                    //fireLog($pig);                    
                array_push($pigs,$pig);    
            }                                    
        }
        
        $totalRecord = count($pigs);
        
        return array_splice($pigs,$start, $end-$start + 1);
    }  
    
    /**
    * Search pig by description
    * 
    * @param mixed $xmlDoc
    * @param mixed $desc
    * @author KietMA
    */
    public function SearchByDesc($xmlDoc, $desc)
    {
        $nodes = $this->LoadAllFromXML($xmlDoc);
        $len = count($nodes);
        $pigs = array();
        $desc = mb_strtolower($desc, AppConstant::CHAR_SET_UTF8);
        
        for($i = 0; $i < $len; $i ++)
        {
            $attName = mb_strtolower($nodes[$i]->name, AppConstant::CHAR_SET_UTF8);
            if ($desc == '')
            {
                $pig = $this->LoadPigByIndex($xmlDoc, $i);
                array_push($pigs,$pig);
            }
            else if((mb_strpos($attName, $desc)  !== false))
            {
                $pig = $this->LoadPigByIndex($xmlDoc, $i);
                array_push($pigs,$pig);
            }
        }
        
        return $pigs;
    }
}    
?>