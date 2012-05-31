<?php
//---------------

class CEventConfigLog
{
	private $arrLog = null;
	
	public function __construct()
	{
		$this->arrLog = array("string" => array());
	}	
	
	public function __destruct()
	{
		unset($this->arrLog);
		$this->arrLog = null;
	}	

	public function GetLog($key = "string")
	{
		return $this->arrLog["{$key}"];
	}
	
	
	public function ClearLog($key = "string")
	{
		unset($this->arrLog["{$key}"]);
		$this->arrLog["{$key}"] = array();
	}

	public function AddStringLog($value, $isAddCurrentDateTime = true)
	{
		$this->AppendLog("string", "{$value}", $isAddCurrentDateTime);
	}
	
	private function AppendLog($key, $value, $isAddCurrentDateTime)
	{
		$this->arrLog["{$key}"][] = (($isAddCurrentDateTime == true) ? ("[" . date("Y-m-d H:i:s") . "] ") : "") . $value;
	}
}

?>
