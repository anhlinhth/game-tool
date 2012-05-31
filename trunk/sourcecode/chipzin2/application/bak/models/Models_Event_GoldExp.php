<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Event_GoldExp extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "event_goldexp";		
	}
	
	public function toString($obj)
	{
		$str = "\n\t array(
			'min' => '{$obj->min}',
			'max' => '{$obj->max}',
			'gold'=> '{$obj->gold}',
			'exp' => '{$obj->exp}'
		),";
					
		return $str;
	}
	
	public function generate($data)
	{
		$str .= "<?php\nreturn array(";
		
		foreach($data as $obj)
		{
			$str .= $this->toString($obj);
		}
		
		$str .= "\n\n);\n?>";
		
		$fp = fopen(EVENT_GOLD_EXP_PHP_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		return true;
	}	
	
	public function sync($data, $location)
	{
		$check = $this->generate($data);
		
		if($check)
		{
			//Backup
			$date = date('Ymd_His');
			if($location == DEV)
			{
				$newDir = FTP_CONFIG_PATH_DEV.$date.DS;
				
				$event = FTP_CONFIG_PATH_DEV.'ExpEvent.php';
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mkdir '. $newDir .'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mv '. $event. ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();
			}
			else if($location == LIVE)
			{
				$event = FTP_CONFIG_PATH_LIVE.'ExpEvent.php';				
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
