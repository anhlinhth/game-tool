<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Popup extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "";
		$this->_table = "popup";		
	}
	
	public function insert($obj)
	{
		$data = Utility::transferObjectToArray($obj);
		$this->_db->insert("popup", $data);
	}
	
	public function update($obj)
	{
		$data = Utility::transferObjectToArray($obj);
		$this->_db->update("popup", $data, null);
	}
	
	public function getPopup()
	{
		$sql = "SELECT
					*
				FROM
					popup";
		
		$data = $this->_db->fetchRow($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function generate($obj,$location)
	{		
		
		if($location == DEV)
			$url = URL_IMAGE_POPUP_DEV . $obj->picname ;
		else
			$url = URL_IMAGE_POPUP_LIVE . $obj->picname ;
		
		$str = "<?php return array( 'url' => '{$url}', 'content' => '{$obj->content}','enabled' => ".(int)$obj->enabled.") \n?>";
		
		$fp = fopen(POPUP_PHP_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		
		return true;
	}
	
	public function sync($data,$location)
	{
		$check = $this->generate($data, $location);
		
		if($check)
		{
			//Backup
			$date = date('Ymd_His');
			if($location == DEV)
			{
				$newDir = FTP_CONFIG_PATH_DEV.$date.DS;
				
				$popup = FTP_CONFIG_PATH_DEV.'Popup.php';
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mkdir '. $newDir .'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_DEV .'" "mv '. $popup. ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();
			}
			else if($location == LIVE)
			{
				$item = FTP_CONFIG_PATH_LIVE.'Popup.php';				
				$newDir = FTP_CONFIG_PATH_LIVE.$date.DS;
				
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_LIVE .'" "mkdir '.$newDir.'" "exit"');
				Utility::runCMD(ROOT_BAT.DS.'winscp.com /command "option confirm off" "open root@'. SERVER_BACKUP_LIVE .'" "mv '. $popup . ' ' .  $newDir .'" "exit"');					
				Utility::showOutput();				
			}
			//
			
			Utility::syncData($location);
			Utility::syncImage($location);
		}
	}
}
?>
