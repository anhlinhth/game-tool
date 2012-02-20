<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
include_once "event_config_import_export.php";

//For Test
define("END_LINE", "<br>");
//define('IMPORT_PATH', "E:\\Son\\Project\\ProjectP\\branches\\update_sep_xheo\\Source\\src\\Server\\configs");
define('IMPORT_PATH', "E:\\xampp\\htdocs\\event\\export");

define('EXPORT_PATH', "E:\\xampp\\htdocs\\event\export");
//-------------------

echo "Importing..." . END_LINE;
ImportAllEvents();

echo "Exporting..." . END_LINE;
ExportAllEvent();

//--------------

function ImportAllEvents()
{
	$importer = new CEventConfigImportExport();
	$connectDBResult = $importer->ConnectToMySQLServerByParams("10.30.9.121", "root", "", "event_config");
//	or
//	$connectDBResult = $importer->SetExistMySQLConnection(&$connection)
	if($connectDBResult == true)
	{
		$numSuccess = $importer->ImportEventsToDB(IMPORT_PATH);
		echo "Importing Result: Number of success = {$numSuccess}" . END_LINE . END_LINE;
	}
	
	$arrLog = $importer->GetLog();
	foreach($arrLog as $log)
	{
		echo "{$log}" . END_LINE;
	}
		
	unset($importer);
}

function ExportAllEvent()
{
	$exporter = new CEventConfigImportExport();
	$connectDBResult = $exporter->ConnectToMySQLServerByParams("10.30.9.121", "root", "", "event_config");
//	or
//	$connectDBResult = $exporter->SetExistMySQLConnection(&$connection)
	if($connectDBResult == true)
	{
		$numSuccess = $exporter->ExportEventsToPHP(EXPORT_PATH);
		echo "Exporting Result: Number of success = {$numSuccess}" . END_LINE . END_LINE;
	}
	
	$arrLog = $exporter->GetLog();
	foreach($arrLog as $log)
	{
		echo "{$log}" . END_LINE;
	}
		
	unset($exporter);
}

function ExportSelectedEvents($exportPath, $arrSelected)
{
	$exporter = new CEventConfigImportExport();
	$connectDBResult = $exporter->ConnectToMySQLServerByParams("10.30.9.121", "root", "", "event_config");
//	or
//	$connectDBResult = $exporter->SetExistMySQLConnection(&$connection)
	if($connectDBResult == true)
	{
		$numSuccess = $exporter->ExportSelectedEventsToPHP($exportPath, $arrSelected);
		echo "Exporting Result: Number of success = {$numSuccess}" . END_LINE . END_LINE;
	}
	
	$arrLog = $exporter->GetLog();
	foreach($arrLog as $log)
	{
		echo "{$log}" . END_LINE;
	}
		
	unset($exporter);
}


?>
