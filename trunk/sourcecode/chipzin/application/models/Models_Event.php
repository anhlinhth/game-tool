<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'exportEventConfig'.DS.'event_config_import_export.php';

class Models_Event extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "event";		
	}
	public function getListEventConfig_Tree($paramArr)
    {
        $SQL = 'SELECT e.id, e.name, e.name_config, e.desc, e.start_date, e.end_date, e.enable  ';
        $SQL .= 'FROM event_config as e';
      
        $result = $this->_db->fetchAll($SQL);
   		
        return $result;    	
    }
	public function getListKeyEvent($idEvent,$idParent)
    {
        $SQL = 'SELECT k.id, k.id_event, k.name, k.desc, k.type, k.value, k.id_parent  ';
        $SQL .= 'FROM event_key as k ';
       	$SQL .= 'WHERE k.id_event = '.$idEvent . ' AND k.id_parent = ' . $idParent;
       	
       	$result = $this->_db->fetchAll($SQL);
      
        return $result;    	
    }    
	public function getKeyParentEvent($idEvent)
    {
        $SQL = 'SELECT k.id  ';
        $SQL .= 'FROM event_key as k ';
       	$SQL .= 'WHERE k.id_event = '.$idEvent . ' AND k.id_parent = 0';
      
       	$result = $this->_db->fetchAll($SQL);
      
        return $result;    	
    }   
    public function getListEventConfig($paramArr)
    {
        $start = isset($paramArr['start'])?$paramArr['start']:NULL;
        $limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
        $sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'id';
        $sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'asc';
        $whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
        
        if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
        else $optLimit = NULL;
        
        if(!empty($whereParam)) $whereClause = " WHERE true ".$whereParam;
        else $whereClause = " where true ";
        $SQL = 'SELECT e.id, e.name, e.name_config, e.desc, e.start_date, e.end_date, e.enable  ';
        $SQL .= 'FROM event_config as e ';
        $SQL .= "$whereClause order by $sortField $sortOrder $optLimit ";
        
       $result = $this->_db->fetchAll($SQL);
        
       return $result;
    }         

    public function getListKeyEventConfig($paramArr)
    {
        $start = isset($paramArr['start'])?$paramArr['start']:NULL;
        $limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
        $sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'id';
        $sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'asc';
        $whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
        $SQL = 'SELECT k.id, k.id_event, k.name, k.desc, t.name as type, k.value, k.id_parent  ';
        $SQL .= 'FROM event_key as k JOIN key_type as t ON k.type = t.id ';        
        if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
        else $optLimit = NULL;
        
        if(!empty($whereParam)) $whereClause = " WHERE true ".$whereParam;
        else $whereClause = " where true ";
        
        $SQL .= "$whereClause order by $sortField $sortOrder $optLimit ";
        
       $result = $this->_db->fetchAll($SQL);
        
       return $result;
    }    

    public function insertEventConfig($paramArr)
    {
        $name = $paramArr['name'];
       	$name_config = $paramArr['name_config'];
       	$desc = $paramArr['desc'];
       	$start_date = $paramArr['start_date'];
       	$end_date = $paramArr['end_date'];
       	$enable = $paramArr['enable'];
       	
        $SQL = 'INSERT INTO event_config(name,name_config,`desc`,start_date,end_date,enable) ';
        $SQL .= "VALUES ('$name','$name_config','$desc','$start_date','$end_date','$enable')";
        
        $result = $this->_db->query($SQL);
        
        $SQL = 'SELECT Max(id) as id FROM event_config';
        
        $result = $this->_db->fetchAll($SQL);        
        $eventInserted = $result[0];
        $idEventInserted = $eventInserted["id"];
       	
        
        $SQL = 'INSERT INTO event_key(id_event,name,`type`,`value`,id_parent) ';
        $SQL .= "VALUES ($idEventInserted,'return',2,'array',0)";
        
        $result = $this->_db->query($SQL);
    }    
    public function deleteEventConfig($paramArr)
    {
        $SQL = 'DELETE FROM event_config WHERE id = ' . $paramArr['id'];
        $result = $this->_db->query($SQL);
    }  
    public function updateEventConfig($paramArr)
    {
    	$id = $paramArr['id'];
        $name = $paramArr['name'];
       	$name_config = $paramArr['name_config'];
       	$desc = $paramArr['desc'];
       	$start_date = $paramArr['start_date'];
       	$end_date = $paramArr['end_date'];
       	$enable = $paramArr['enable'];  

        $SQL = 'UPDATE event_config ';
        $SQL .= "SET name = '$name',name_config='$name_config', `desc` = '$desc', start_date = '$start_date',start_date='$start_date',enable=$enable WHERE id= $id";
        $result = $this->_db->query($SQL);       	
    }      
    public function insertKeyEventConfig($paramArr)
    {
    	$idEventSelect = $paramArr['idEventSelect'];
    	$id_parent = $paramArr['id_parent'];
        $name = $paramArr['name'];
       	$desc = $paramArr['desc'];
       	$type = $paramArr['type'];
       	$value = $paramArr['value'];
       	
        $SQL = 'INSERT INTO event_key(id_event,name,`type`,`value`,id_parent) ';
        $SQL .= "VALUES ($idEventSelect,'$name',2,'array',$id_parent)";
        
        $result = $this->_db->query($SQL);
    }        
    public function updateKeyEventConfig($paramArr)
    {
    	$id = $paramArr['id'];
        $name = $paramArr['name'];
       	$desc = $paramArr['desc'];
       	$type = $paramArr['type'];
       	$value = $paramArr['value'];

        $SQL = 'UPDATE event_key ';
        $SQL .= "SET name = '$name',`desc` = '$desc', type = '$type',value='$value' WHERE id= $id";
        $result = $this->_db->query($SQL);       	
    }   
    public function deleteKeyEventConfig($paramArr)
    {
        $SQL = 'DELETE FROM event_config_key WHERE id = ' . $paramArr['id'];
        $result = $this->_db->query($SQL);
    }  
    public function exportEventConfig($arrListEvent)
    {
        $SQL = 'SELECT id,name_config as name FROM event_config WHERE id IN('. $arrListEvent .')';
        $result = $this->_db->fetchAll($SQL);  
        $count = count($result);
        $arrSelected =  array();
        for($i=0;$i<$count;$i++)
        {
        	$event = $result[$i];
        	$arrSelected[$event["id"]] = $event["name"];
        }   
       $result = $this->ExportSelectedEvents(ROOT_FILE,$arrSelected);
       return $result;
    }   
	function ExportSelectedEvents($exportPath, $arrSelected)
	{
		$arrConfig = $this->LoadConfigFile();
		
		$exporter = new CEventConfigImportExport();
		$connectDBResult = $exporter->ConnectToMySQLServerByParams($arrConfig['host'], $arrConfig['username'], $arrConfig['password'], $arrConfig['dbname']);
		unset($arrConfig);

		if($connectDBResult == true)
		{
			$numSuccess = $exporter->ExportSelectedEventsToPHP($exportPath, $arrSelected);
			//echo "Exporting Result: Number of success = {$numSuccess}" . END_LINE . END_LINE;
		}
		$log = $exporter->GetLog();
		
		unset($exporter);
		return $log;
	} 
    public function importEventConfig($arrListEvent)
    {
        $SQL = 'DELETE FROM event_key WHERE id_event IN('. $arrListEvent .')';
        $result = $this->_db->query($SQL);
            	
        $SQL = 'SELECT id,name_config as name FROM event_config WHERE id IN('. $arrListEvent .')';
        $result = $this->_db->fetchAll($SQL);  
        $count = count($result);
        $arrSelected =  array();
        for($i=0;$i<$count;$i++)
        {
        	$event = $result[$i];
        	$arrSelected[$event["id"]] = $event["name"];
        }   
       $result =  $this->ImportSelectedEvents(ROOT_IMPORT_FILE,$arrSelected);
       return $result;
        
    }   
	function ImportSelectedEvents($importPath, $arrSelected)
	{
		$arrConfig = $this->LoadConfigFile();
				
		$importer = new CEventConfigImportExport();
		$connectDBResult = $importer->ConnectToMySQLServerByParams($arrConfig['host'], $arrConfig['username'], $arrConfig['password'], $arrConfig['dbname']);
		unset($arrConfig);
		
		if($connectDBResult == true)
		{
			$numSuccess = $importer->ImportSelectedEventsToDB($importPath, $arrSelected);
			//echo "Importing Result: Number of success = {$numSuccess}" . END_LINE . END_LINE;
		}
		
		$log = $importer->GetLog();
		unset($importer);
		return $log;
	}

	function LoadConfigFile()
	{
		$config = new Zend_Config_Ini(ROOT_CONFIG.DS.'config.ini','db');
		
		$result = array();
		$result['dbname'] = $config->db->params->dbname;
		$result['host'] = $config->db->params->host;
		$result['username'] = $config->db->params->username;
		$result['password'] = $config->db->params->password;
		
		
		unset($config);
		
		return $result;
	}
	
}
?>
