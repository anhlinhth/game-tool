<?php
include_once "event_config_import_export_define.php";
include_once "event_config_php.php";
include_once "event_config_mysql.php";
include_once "event_config_log.php";
//---------------

class CEventConfigImportExport
{
	private $logObj = null;

	public function __construct()
	{
		$this->logObj = new CEventConfigLog();

		CEventConfigPHP::getInstance()->attachLogObj($this->logObj);
		CEventConfigMYSQL::getInstance()->attachLogObj($this->logObj);
		
	}	
	
	public function __destruct()
	{
		CEventConfigMYSQL::getInstance()->disconnectToMySQLServer();	

		CEventConfigPHP::getInstance()->detachLogObj();
		CEventConfigMYSQL::getInstance()->detachLogObj();
		
		unset($this->logObj);
	}	

	public function SetExistMySQLConnection(&$connection)
	{
		$connectDBResult = CEventConfigMYSQL::getInstance()->setExistConnection($connection);
		
		return $connectDBResult;
	}

	public function ConnectToMySQLServerByParams($mysqlIP, $mysqlUser, $mysqlPassword, $mysqlDBName)
	{
		$connectDBResult = CEventConfigMYSQL::getInstance()->connectToMySQLServer($mysqlIP, $mysqlUser, $mysqlPassword, $mysqlDBName);
		
		return $connectDBResult;
	}
	
//Import	
	public function ImportEventsToDB($importPath, $eventListFilter = "", $eventList = array())
	{
		$result = 0;
		
		if(empty($eventList)) //Get all events from db
		{
			$eventList = CEventConfigMYSQL::getInstance()->getEventListFileFromDB($eventListFilter);
		}
		
		$result = $this->ImportSelectedEventsToDB($importPath, $eventList);

		unset($eventList);
		
		return $result;
	}
	
	public function ImportSelectedEventsToDB($importPath, &$arrFiles)
	{
		if(empty($arrFiles))
		{
			return 0;
		}
		
		if(!is_dir($importPath))
		{
			$this->logObj->AddStringLog("Folder {$importPath} does not exist. Cannot import.");
			return 0;
		}		
		
		$result = 0;
		foreach($arrFiles as $curId => $curFile)
		{
			$fullFilename = $importPath . EVENT_CONFIG_FOLDER_SEP . $curFile;
			$loadPHPResult = CEventConfigPHP::getInstance()->loadPHPFile($fullFilename);
			if($loadPHPResult == false)
			{
				$this->logObj->AddStringLog("Cannot load content from file {$fullFilename}");
				continue;
			}
			
			$arrPHPContent = CEventConfigPHP::getInstance()->getPHPContent();
			
			if($arrPHPContent == null)
			{
				$this->logObj->AddStringLog("Load NULL from file {$fullFilename}");
				continue;
			}
			
			$importResult = CEventConfigMYSQL::getInstance()->importDataToDB($curId, $arrPHPContent);
			unset($arrPHPContent);
			
			if($importResult === false)
			{
				$this->logObj->AddStringLog("Cannot import to db from file {$fullFilename}");
				continue;
			}

			$this->logObj->AddStringLog("Import success file {$fullFilename}");
			$result++;
			
		}

		return $result;
	}
//-------------

//Export
	public function ExportEventsToPHP($exportPath, $eventListFilter = "", $eventList = array())
	{
		$result = 0;
		
		if(empty($eventList)) //Get all events from db
		{
			$eventList = CEventConfigMYSQL::getInstance()->getEventListFileFromDB($eventListFilter);
		}
		
		$result = $this->ExportSelectedEventsToPHP($exportPath, $eventList);

		unset($eventList);
		
		return $result;
	}
	
	public function ExportSelectedEventsToPHP($exportPath, &$arrFiles)
	{
		//$arrFiles contains key = eventId and value = export_file_name.php
		if(empty($arrFiles))
		{
			return 0;
		}
		
		if(!is_dir($exportPath))
		{
			$this->logObj->AddStringLog("Folder {$exportPath} does not exist. Cannot export.");
			return 0;
		}
		
		$result = 0;
		foreach($arrFiles as $curId => $curFile)
		{
			$fullFilename = $exportPath . EVENT_CONFIG_FOLDER_SEP . $curFile;
			
			$arrPHPContent = CEventConfigMYSQL::getInstance()->exportDataFromDB($curId);
			
			$savePHPResult = CEventConfigPHP::getInstance()->saveToPHPFile($arrPHPContent[EVENT_CONFIG_ROOT_NAME] , $fullFilename);

			unset($arrPHPContent);
			
			if($savePHPResult === false)
			{
				$this->logObj->AddStringLog("Cannot save content to file {$fullFilename}");
				continue;
			}

			$this->logObj->AddStringLog("Export success file {$fullFilename}");
			
			$result++;
		}
		
		return $result;
	}
	
//--------------

	public function GetLog()
	{
		if($this->logObj == null) return array();
		return $this->logObj->GetLog();
	}
	
}

//IMPORT
//$importer = new CEventConfigImportExport();
//$connectDBResult = $importer->ConnectToMySQLServerByParams("10.30.9.121", "root", "", "event_config");
//or
//$connectDBResult = $importer->SetExistMySQLConnection(&$connection)
//if($connectDBResult == true)
//{
//	$numSuccess = $importer->ImportEventsToDB("E:\\Son\\Project\\ProjectP\\branches\\update_sep_xheo\\Source\\src\\Server\\configs");
//}
//
//unset($importer);
//------------------


//EXPORT
//$exporter = new CEventConfigImportExport();
//$connectDBResult = $exporter->ConnectToMySQLServerByParams("10.30.9.121", "root", "", "event_config");
//or
//$connectDBResult = $exporter->SetExistMySQLConnection(&$connection)
//if($connectDBResult == true)
//{
//	$numSuccess = $exporter->ExportEventsToPHP("E:\\xampp\\htdocs\\event\export");
//}
//unset($exporter);
//--------------


?>
