<?php
require_once ROOT_APPLICATION_MODELS.DS.'Common.php';
class Pig
{
    public $id;
	public $type;
	public $gender;
	public $statusInShop;
	public $quantity;
	public $name;
	public $shortDesc;
	public $stealPunish;	
	public $level;
	public $specialPig;
	public $lifeCycle;
	public $health;
	public $weightGainPerHour;
	public $weightDownPerHour;
	public $priceForOneKg;
	public $weight;
	public $priceInGame;
	public $priceOutGame;
	public $unit;
	public $image;
	public $status;
	public $age;
	public $begetPrice;
	public $begetPriceMax;
	public $giftGoldMinHome;
	public $giftGoldMaxHome;
	public $giftGoldMinFriend;
	public $giftGoldMaxFriend;
	public $sellExp;
	public $group;
	public $holyLevel;
	public $star;
	public $miniGame;
	public $desUser;
	public $lvGF;
	public $disCount;
	public $new;
	public $enableInShop;
	
	public function ToString()
	{
		$lifeCircle = $this->lifeCycle * 24;
        if( $this->disCount > 0 )
        {
            $this->priceOutGame = intval(($this->priceOutGame * $this->disCount) / 100) ;
        }
		$str = "\n\t'{$this->type}_{$this->gender}' =>
	array(
		'id' => '{$this->id}',
		'type' => '{$this->type}_{$this->gender}',
        'description' => '',
		'statusInshop' => '{$this->statusInShop}',
		'quantity' => '',
		'name' => '{$this->name}',
		'shortDes' => '{$this->shortDesc}',
		'stealPunish' => {$this->stealPunish},
		'begetPrice' => {$this->begetPrice},
		'begetPriceMax' => {$this->begetPriceMax},
		'level' => {$this->level},
		'lifeCycle' => {$lifeCircle},
		'statusIndex' => {$this->health},
		'weightGainPerHour' => {$this->weightGainPerHour},
		'weightDownPerHour' => {$this->weightDownPerHour},
		'priceForOneKg' => {$this->priceForOneKg},
		'weight' => {$this->weight},
		'priceInGame' => {$this->priceInGame},
		'priceOutGame' => {$this->priceOutGame},
		'unit' => {$this->unit},
		'image' => '{$this->image}',
		'status' => '";
		for($i = 0; $i < count($this->status); $i ++)
		{
			$str .= $this->status[$i] . ",";
		}
		$str = trim($str, ",");
		$str .= "'," .
		"
		'age' => {$this->age},
		'specialPig' => {$this->specialPig},
		'sellExp' => {$this->sellExp},
		'group' => '{$this->group}',
		'holyLevel' => '{$this->holyLevel}',
		'star' => {$this->star},
		'enableInShop' => {$this->enableInShop},
	),";
		
		return $str;
	}
	
	public function LoadPig($xmlDoc, $node)
	{
	    $this->id = $node->getAttribute('id');		
		$nodeValue = $node->getAttribute('type');
		$arrayValue = explode("_", $nodeValue);
		$this->type = $arrayValue[0];
		$this->gender = $arrayValue[1];
		
		$this->statusInShop = $node->getAttribute('statusInShop');
		
		$quantity = $xmlDoc->getElementsByTagName('pigs')->item(0)->getAttribute('quantity');
		$this->quantity = $quantity;
		
		$this->name = $node->getAttribute('name');
		$this->shortDesc = $node->getAttribute('shortDes');
		$this->stealPunish = $node->getAttribute('stealPunish');
		$this->begetPrice = $node->getAttribute('begetPrice');
		$this->begetPriceMax = $node->getAttribute('begetPriceMax');
		$this->level = $node->getAttribute('level');
		$this->specialPig = $node->getAttribute('specialPig');
		
		$nodeValue = $node->getAttribute('values');
		$arrayValue = explode(";", $nodeValue);
		
		$this->lifeCycle = $arrayValue[0] / 24;
		$this->health = $arrayValue[1];
		$this->weightGainPerHour = $arrayValue[2];
		$this->weightDownPerHour = $arrayValue[3];
		$this->priceForOneKg = $arrayValue[4];
		$this->weight = $arrayValue[5];
		$this->priceInGame = $arrayValue[6];
		$this->priceOutGame = $arrayValue[7];
		$this->unit = $arrayValue[8];
		$this->image = $arrayValue[9];
		$this->status = explode(",",$arrayValue[10]);
		$this->age = $arrayValue[11];		
		$this->giftGoldMinHome = $node->getAttribute('giftGoldMinHome');
		$this->giftGoldMaxHome = $node->getAttribute('giftGoldMaxHome');
		$this->giftGoldMinFriend = $node->getAttribute('giftGoldMinFriend');
		$this->giftGoldMaxFriend = $node->getAttribute('giftGoldMaxFriend');
		$this->sellExp = $node->getAttribute('sellExp');
		$this->group = $node->getAttribute('group');
		$this->holyLevel = $node->getAttribute('holyLevel');
		if($node->getAttribute('star') > 0)
		{
			$this->star = $node->getAttribute('star') * 86400;	
		}
		else
		{
			$this->star = $node->getAttribute('star') ;
		}
		
		$this->miniGame = $node->getAttribute('miniGame');
		$this->desUser = $node->getAttribute('desUser');
		$this->lvGF = $node->getAttribute('lvGF');
		$this->disCount = $node->getAttribute('disCount');
		$this->new = $node->getAttribute('new');
		$this->enableInShop = $node->getAttribute('enableInShop');
	}
	
	public function LoadDislayData($node)
	{
		$this->id = $node->getAttribute('id');
		$this->type = $node->getAttribute('type');
		$nodeValue = $node->getAttribute('type');
		$arrayValue = explode("_", $nodeValue);
		$this->gender = $arrayValue[1];			
		$this->name = $node->getAttribute('name');
		$nodeValue = $node->getAttribute('values');
		$arrayValue = explode(";", $nodeValue);		
		$this->priceInGame = $arrayValue[6];
		$this->priceOutGame = $arrayValue[7];
		$this->image = $arrayValue[9];
        $this->enableInShop = $node->getAttribute('enableInShop');
        $this->disCount = $node->getAttribute('disCount');
	}
    
    // KietMA added to lock key pig
    public static function lockPigs($playerId, $isWait=true)
    {
        $key = "pig_{$playerId}";
        return Common::lock($key, 20, $isWait);
    }
    
    public static function unlockPigs($playerId)
    {
        $key = "pig_{$playerId}";
        return Common::unlock($key);
    }
}
?>
