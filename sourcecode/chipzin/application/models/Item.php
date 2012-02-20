<?php
	class Item
	{
		public $id;
		public $type; //3,1 - groupitem, 4,2 - item,
		public $description;
		public $haveDefault;
		public $name;
		public $image;
		public $priceInGame;
		public $priceOutGame;
		public $quantity;
		public $status;
		public $currentStatus;
		public $key;
		public $effect;
		public $level;
		public $limited;
		public $useAtHome;
		public $maxLevel;
		public $exp;
		public $refineLevel;
		public $disCount;
		public $expiredCoin;
		public $enableInShop;
        public $effectProperties = array();
		public $giftType;
		public $giftPackage;
		
		public function ToString()
		{		
			if($this->haveDefault == "" || $this->haveDefault == "false")
			{
				$haveDefault = "0";
			}
			else
			{
				$haveDefault = "1";
			}
			$str = "\n\t{$this->id} =>
	array(
		'id' => {$this->id},
		'type' => {$this->type},
		'description' => '{$this->description}',
		'haveDefault' => {$haveDefault},
		'name' => '{$this->name}',
		'image' => '{$this->image}',
		'priceInGame' => {$this->priceInGame},
		'priceOutGame' => {$this->priceOutGame},
		'quantity' => {$this->quantity},		
		'status' =>  array (";
		
		for($i = 0; $i < count($this->status); $i ++)
		{
			$str .= $this->status[$i] . ",";
		}
		$str = trim($str, ",");
		$str .= ")," .
		
		"
		'currentStatus' => {$this->currentStatus},
		'key' => '{$this->key}',";
		
		if($this->key == "SINH_NHANH" || $this->key == "TRUONG_THANH_NHANH" || $this->key == "TANG_TUOI_THO")
		{
			$second = $this->effect * 3600 ;
			$str .= "
		'effect' => array('{$this->key}'=>{$second}),";			
		}
		else
				{
					$str .= "
		'effect' => array('{$this->key}'=>{$this->effect}),";
				}
		
		$str .= "
		'level' => {$this->level},
		'limited' => {$this->limited},
		'useAtHome' => {$this->useAtHome},
		'maxLevel' => {$this->maxLevel},
		'exp' => {$this->exp},
		'refineLevel' => {$this->refineLevel},
        'expiredCoin' => {$this->expiredCoin},
		'disCount' => {$this->disCount},		
		'enableInShop' => {$this->enableInShop},
	" ;
    
        if( $this->effectProperties == null )
        {
            $str .= ")," ;
            return $str;
        }
        else
        {
            $str .= " 'effectProperties' => array( " ;
            for( $i = 0 ; $i < count( $this->effectProperties ); $i ++ )
            {
                if( $this->effectProperties[$i] != "")
                {
                    $str .= "array('{$this->effectProperties[$i]}',), " ;
                }
                else
                {
                    $str .= "null, " ;
                }
            }
            $str .= "),\n)," ;
                
        }
        	
		return $str;
		}
		
		public function LoadItem($xmlDoc, $node)
		{
		    $this->id = $node->getAttribute('id');
			$this->type = $node->getAttribute('type');
			$this->description = $node->getAttribute('description');
			$this->haveDefault = $node->getAttribute('haveDefault');
			
			$nodeValue = $node->getAttribute('values');
			$arrayValue = explode(";", $nodeValue);
			
			$this->name = $arrayValue[0];
			$this->image = $arrayValue[1];
			$this->priceInGame = $arrayValue[2];
			$this->priceOutGame = $arrayValue[3];
			$this->quantity = $arrayValue[4];
			$this->status = explode(",", $arrayValue[5]);
			$this->currentStatus = $arrayValue[6];
			$this->key = $arrayValue[7];
			$this->effect = $arrayValue[8];
			$this->level = $arrayValue[9];
			$this->limited = $arrayValue[10];
			$this->useAtHome = $node->getAttribute('useAtHome');
			$this->maxLevel = $node->getAttribute('maxLevel');
			$this->exp = $node->getAttribute('exp');
			$this->refineLevel = $node->getAttribute('refineLevel');
			//$this->limited /= 24 ;
			$this->disCount = $node->getAttribute('disCount');
			$this->expiredCoin = $node->getAttribute('expiredCoin');
			$this->enableInShop = $node->getAttribute('enableInShop');
			$this->giftType		= $node->getAttribute('giftType');
			$this->giftPackage	= $node->getAttribute('giftPackage');
            
            $properties = $node->getElementsByTagName('effectProperties')->item(0);
            if( $properties == null )
            {
                $this->effectProperties = null;
            }
            else
            {
                $properties = $properties->getElementsByTagName('effectProperty') ;
                for( $i = 0; $i < $properties->length ; $i ++)
                {
                    array_push( $this->effectProperties, $properties->item($i)->getAttribute('values') );
                }    
            }
            
		}	
		
		public function LoadDislayData($node)
		{
			$this->id = $node->getAttribute('id');
	
			$nodeValue = $node->getAttribute('values');
			$arrayValue = explode(";", $nodeValue);
			
			$this->name = $arrayValue[0];
			$this->image = $arrayValue[1];
			$this->priceInGame = $arrayValue[2];
            $this->priceOutGame = $arrayValue[3];
			$this->type = $node->getAttribute('type');
            $this->disCount = $node->getAttribute('disCount');
            $this->enableInShop = $node->getAttribute('enableInShop');
		}	
    
    // KietMA added to lock key player item
    public static function lockPlayerItems($playerId, $isWait=true)
    {
        $key = "item_{$playerId}";
        return Common::lock($key, 20, $isWait);
    }
    
    public static function unlockPlayerItems($playerId)
    {
        $key = "item_{$playerId}";
        return Common::unlock($key);
    }
    
    // KietMA added to lock key player item
    public static function lockPlayerGroupItems($playerId, $isWait=true)
    {
        $key = "groupitem_{$playerId}";
        return Common::lock($key, 20, $isWait);
    }
    
    public static function unlockPlayerGroupItems($playerId)
    {
        $key = "groupitem_{$playerId}";
        return Common::unlock($key);
    }
}
?>