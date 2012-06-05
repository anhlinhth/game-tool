<?php
class Models_C_Restore
{
	function restore($file){		
	
  //this is the file you are loading your tables from
  $file2 = fopen($file,"r+");
 
  $line_count = $this->load_backup_sql($file2);
 // fclose($file);
  if($line_count!= null)
  return 1;
  else {
  	return 0;
  }
	}

  function load_backup_sql($file) {
    $line_count = 0;
    $db_connection = $this->db_connect();
    mysql_select_db ($this->db_name()) or exit();
    $line_count = 0;
	
	
    while (!feof($file)) {
      $query = NULL;
	  
	 
	  
      while (!feof($file)) {
        $query = fgets($file);
		
		if (NULL != $query) {
        $line_count++;
		 mysql_query($query) or die("sql not successful: ".mysql_error()." query: ".$query);
      }
		
      }
	  
	  
      
	  
    }  
    return $line_count;
	
	
	
  }
  
  function db_name() {
  	$dbp = $this->loadConfig();
      return $dbp['dbname'];
  }
  
  function db_connect() {
  	$dbc=$this->loadConfig();
    $db_connection = mysql_connect($dbc['host'], $dbc['username'], $dbc['password']);
    return $db_connection;
  }  
  function loadConfig()
	{
		$config = new Zend_Config_Ini(ROOT_APPLICATION_CONFIGS.DS.'application.ini','db');
		
		$result = array();
		$result['dbname'] = $config->db->params->dbname;
		$result['host'] = $config->db->params->host;
		$result['username'] = $config->db->params->username;
		$result['password'] = $config->db->params->password;
		return $result;
	}
	}
  ?>