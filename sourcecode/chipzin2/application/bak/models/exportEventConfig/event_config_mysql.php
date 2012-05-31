<?php
include_once "event_config_import_export_define.php";
include_once "event_config_log.php";

//Singleton class
class CEventConfigMYSQL
{

    private static $instance = null;
	private $db = null;
	private $isExternalConnection = false;
	private $logObj = null;
	
	private function __construct()
	{
	}
	
	public function __destruct()
	{
		$this->disconnectToMySQLServer();	
	}
	
	public static function getInstance()
	{
		if(empty(self::$instance))
		{
			self::$instance = new CEventConfigMYSQL();
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
	
	public function setExistConnection(&$connection)
	{
		$this->disconnectToMySQLServer();
		
		if($connection != null)
		{
			$this->isExternalConnection = true;
			$this->db = $connection;
		}
	}
		
	public function connectToMySQLServer($hostname, $username, $password, $dbname)
	{
		$this->disconnectToMySQLServer();
		
		$this->db = new mysqli($hostname, $username, $password, $dbname);
		$this->isExternalConnection = false;
		
		if(mysqli_connect_errno())
		{
			$this->addLog("Connect failed: " . mysqli_connect_error());
			$this->db = null;
			return false;
		}

		$this->db->set_charset("utf8");
		
		return true;
	}
	
	public function disconnectToMySQLServer()
	{
		if($this->db != null && $this->isExternalConnection == false)
		{
			$this->db->close();
		}
		
		$this->db = null;
	}

	public function selectSQL($sql)
	{		
		if(empty($sql)) return false;
		if($this->db == null) return false;
		
		$result = $this->db->query($sql);
		if($result == false)
		{
			$this->addLog("SelectSQL failed: " . $this->db->errno . " - " . $this->db->error);
		}
		
		return $result;
	}
	
	public function executeSQL($sql)
	{		
		if(empty($sql)) return false;
		if($this->db == null) return false;
		
		$result = $this->db->real_query($sql);
		if($result == false)
		{
			$this->addLog("ExecSQL failed: " . $this->db->errno . " - " . $this->db->error);
		}
		
		return $result;
	}

//For Import	
	public function getEventListFileFromDB($condition = "")
	{
		$selectResult = $this->selectSQL("select id, name_config from event" . (empty($condition) ? "" : " where {$condition}"));
		
		$arrResult = array();
		
		while($curRow = $selectResult->fetch_row())
		{
			$arrResult["{$curRow[0]}"] = $curRow[1];
		}
		
		unset($selectResult);
		
		return $arrResult;
		
	}

	public function getDBTypeOfValue(&$value)
	{
		if(is_array($value))
		{
			return EVENT_CONFIG_DB_TYPE_ARRAY; //2:Array
		}
		else if(is_string($value))
		{
			return EVENT_CONFIG_DB_TYPE_STRING; //0:String
		}
		
		return EVENT_CONFIG_DB_TYPE_NUMERIC; //1:Numeric
	}
	
	
	public function importDataToDB($eventId, &$arrPHPContent)
	{
		if(!is_array($arrPHPContent))
		{
			return false; // $arrPHPContent need to be a array as begining
		}
		
		$result = $this->execImportCommand($eventId, EVENT_CONFIG_ROOT_LEVEL, EVENT_CONFIG_ROOT_NAME, $arrPHPContent);
		
		return $result;
	}
	
	private function execImportCommand($eventId, $parentId, $key, &$value)
	{
		//debugUtils::callStack(debug_backtrace());		
		
		$dbType = $this->getDBTypeOfValue($value);
		if($dbType != EVENT_CONFIG_DB_TYPE_ARRAY)
		{
			$strSQL = "insert into event_key (id_event, type, name, value, id_parent) VALUES ({$eventId}, {$dbType}, '{$key}', '{$value}', {$parentId})";

			$result = $this->executeSQL($strSQL);
			
			return $result;
		}
		
		//$dbType == EVENT_CONFIG_DB_TYPE_ARRAY - Recursive

		$strSQL = "insert into event_key (id_event, type, name, value, id_parent) VALUES ({$eventId}, {$dbType}, '{$key}', '" . EVENT_CONFIG_DB_TYPE_ARRAY_STRING . "', {$parentId})";
		$result = $this->executeSQL($strSQL);
		if($result === false)
		{
			return false;
		}
		
		$nextParentId = $this->getIDOfArrayItem($eventId, $dbType, $key, $parentId);
		
		if($nextParentId == false)
		{
			return false;
		}
		
		foreach($value as $key2 => $value2)
		{
			$result = $this->execImportCommand($eventId, $nextParentId, $key2, $value2);
		}
		
		return $result;
	}
	
	private function getIDOfArrayItem($eventId, $dbType, $dbName, $parentId)
	{
		$strSQL = "select id from event_key where id_event = {$eventId} and type = {$dbType} and name = '{$dbName}' and id_parent = {$parentId}";
		$selectResult = $this->selectSQL($strSQL);
		if($selectResult === false)
		{
			$this->addLog("Got problem when select data of event {$eventId} in db.");
			//die();
			return false;
		}

		$curRow = $selectResult->fetch_row();
		if(empty($curRow))
		{
			return false;
		}
		
		$id = $curRow[0];
		
		unset($selectResult);
		return $id;
	}
	
//For Export
	public function exportDataFromDB($eventId)
	{
		$idOfRoot = $this->getIDOfArrayItem($eventId, EVENT_CONFIG_DB_TYPE_ARRAY, EVENT_CONFIG_ROOT_NAME, EVENT_CONFIG_ROOT_LEVEL);
		if($idOfRoot == false)
		{
			$this->addLog("Cannot google root of event {$eventId}.");
			return array();
		}
		
		$arrContent = array();
		$this->execExportCommand($eventId, EVENT_CONFIG_ROOT_LEVEL, $arrContent);
		
		return $arrContent;
	}
	
	private function execExportCommand($eventId, $parentId, &$arrResult)
	{
		$strSQL = "select id, type, name, value, id_parent from event_key where id_event = {$eventId} and id_parent = {$parentId}";
		$selectResult = $this->selectSQL($strSQL);
		if($selectResult === false)
		{
			$this->addLog("Got problem when select data of event {$eventId} in db.");
			//die();
			return;
		}

		//Get to arrTmp to avoid make nested $selectResult
		$arrTmp = array();
		while($curRow = $selectResult->fetch_row())
		{
			$arrTmp[] = array($curRow[0], $curRow[1], $curRow[2], $curRow[3], $curRow[4]);
		}
		unset($selectResult);
		//----
		
		foreach($arrTmp as $arrItem)
		{
			//$arrItem[0]: id; $arrItem[1]: type; $arrItem[2]: name; $arrItem[3]: value; $arrItem[4]: id_parent
			if($arrItem[1] == EVENT_CONFIG_DB_TYPE_STRING)
			{
				$arrResult[($arrItem[2])] = $arrItem[3];
				continue;
			}

			if($arrItem[1] == EVENT_CONFIG_DB_TYPE_NUMERIC)
			{
				$arrSplitNumber = explode(".", $arrItem[3]);
				if(count($arrSplitNumber) > 1)
				{
					$arrResult[($arrItem[2])] = (double)$arrItem[3];
				}
				else
				{
					$arrResult[($arrItem[2])] = (int)$arrItem[3];
				}
				continue;
			}
			
			
			//$arrItem[1] != EVENT_CONFIG_DB_TYPE_ARRAY
			$arrResult[($arrItem[2])] = array();
			$parentId2 = $this->getIDOfArrayItem($eventId, EVENT_CONFIG_DB_TYPE_ARRAY, $arrItem[2], $arrItem[4]);
			if($parentId2 == false)
			{
				$this->addLog("Cannot google id of item has parentId = {$arrItem[4]}.");
				return;
			}
			
			$this->execExportCommand($eventId, $parentId2, $arrResult[($arrItem[2])]);
		}
		unset($arrTmp);
	}
	
	
	
}		
?>