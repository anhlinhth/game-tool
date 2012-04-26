<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Event_NamThien extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "";
		$this->_table = "event_namthien";		
	}
	
	public function update($obj)
	{
		$data = Utility::transferObjectToArray($obj);
		$this->_db->update("event_namthien", $data, null);
	}	
	
	public function getEvent()
	{
		$sql  = "SELECT
					*
				FROM
					event_namthien";
		
		$data = $this->_db->fetchRow($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function generate($obj)
	{
		$str .= "<?php\nreturn array(\n";
		
		//BuyKiss
		$arrBuyKiss = explode(",", $obj->buy_kiss);
		if($arrBuyKiss)
		{
			$size = count($arrBuyKiss);
			$count = 0;
			$str.="\t'buyKiss' => array(";
			foreach($arrBuyKiss as $row)
			{
				$tmp = explode(":", $row);
				$str .= "{$tmp[0]}=>{$tmp[1]}";
				$count++;
				if($count < $size)
					$str .= ",";
			}
			$str.="),\n";
		}
			
		//Quest
		$arrQuest	= explode(",", $obj->quest);
		if($arrQuest)
		{
			$size = count($arrQuest);
			$count = 0;
			$str.="\t'quest' => array(";
			foreach($arrQuest as $row)
			{
				$tmp = explode(":", $row);
				$str .= "{$tmp[0]}=>{$tmp[1]}";
				$count++;
				if($count < $size)
					$str .= ",";
			}
			$str.="),\n";
		}
		
		//Gift
		$str .= "\t'specialGift' => ". (int)$obj->special_gift.",\n";
		
		//Dap heo dat
		$arrHitPig	= explode(",", $obj->hit_pig);
		if($arrHitPig)
		{
			$size = count($arrHitPig);
			$count = 0;
			$str.="\t'beatPig' => array(";
			foreach($arrHitPig as $row)
			{
				$tmp = explode(":", $row);
				$str .= "{$tmp[0]}=>{$tmp[1]}";
				$count++;
				if($count < $size)
					$str .= ",";
			}
			$str.=")";
		}
		
		$str .= "\n\n);\n?>";
		
		$fp = fopen(EVENT_NAMTHIEN_PHP_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		return true;
	}
	
	public function sync($data,$location)
	{
		$check = $this->generate($data);
		
		if($check)
		{
			//Backup
			$date = date('Ymd_His');
			if($location == DEV)
			{
				$newDir = FTP_CONFIG_PATH_DEV.$date.DS;
				
				$event = FTP_CONFIG_PATH_DEV.'EventKimInLenh.php';
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mkdir '. $newDir .'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mv '. $event. ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();
			}
			else if($location == LIVE)
			{
				$event = FTP_CONFIG_PATH_LIVE.'EventKimInLenh.php';				
				$newDir = FTP_CONFIG_PATH_LIVE.$date.DS;
				
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_LIVE .'" "mkdir '.$newDir.'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_LIVE .'" "mv '. $event . ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();				
			}
			//
			
			Utility::syncData($location);
		}
			
	}
}
?>
