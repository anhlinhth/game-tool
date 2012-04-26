<?php
require_once('GameConstant.php');

include_once "event_config_import_export_define.php";
include_once "event_config_log.php";

//Singleton class
class CEventConfigPHP
{
    private static $instance = null;
	private $phpContent = null;
	private $logObj = null;
	
	private function __construct()
	{
	
	}
	
	public function __destruct()
	{
	}
		
	public static function getInstance()
	{
		if(empty(self::$instance))
		{
			self::$instance = new CEventConfigPHP();
		}
		
		return self::$instance;
	}
	
	//For Log
	public function attachLogObj(&$logObj)
	{
		$this->logObj = $logObj;
	}

	public function detachLogObj()
	{
		$this->logObj = null;
	}

	public function addLog($value)
	{
		if($this->logObj == null) return;
		$this->logObj->AddStringLog($value);
	}		
	//End - For Log
	
	public function loadPHPFile($filename)
	{

		if(!empty($this->phpContent))
		{
			unset($this->phpContent);
		}
		
		if(!file_exists($filename))
		{
			//$this->addLog("Cannot load file " . $filename);
			return false;
		}

		$this->phpContent = require("{$filename}");
		
		return (!empty($this->phpContent));
		
	}
	
	public function getPHPContent()
	{
		return $this->phpContent;
	}

	//Export
	public function saveToPHPFile(&$arrContent, $filename)
	{
		if(empty($arrContent))
		{
			return false;
		}
		$strPHPContent = var_export($arrContent, true);
		$fileHandle = fopen($filename, "w");
		if($fileHandle == false)
		{
			//$this->addLog("Cannot save to file " . $filename);
			return false;
		}

		fputs($fileHandle, "<?php \n");
		fputs($fileHandle, "return " . $strPHPContent . "; \n");
		fputs($fileHandle, "?>");
		
		fclose($fileHandle);
		
		unset($strPHPContent);

		return true;
	}
	
}

?>