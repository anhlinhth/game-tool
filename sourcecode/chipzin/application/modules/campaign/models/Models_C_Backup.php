<?php

class Models_C_Backup{
	
	function loadConfig()
	{
		$config = new Zend_Config_Ini(ROOT_CONFIG.DS.'config.ini','db');
		
		$result = array();
		$result['dbname'] = $config->db->params->dbname;
		$result['host'] = $config->db->params->host;
		$result['username'] = $config->db->params->username;
		$result['password'] = $config->db->params->password;
		return $result;
	}
	
function create()
{
    $ccyymmdd = date("Y-m-d_H-i");
  $file = fopen('C:\xampp\htdocs\chipzin\backup_data'.DS."backup_".$ccyymmdd.".sql","w");
  $line_count =$this->create_backup_sql($file);
  fclose($file);
  echo "KQ: ".$line_count;


}

  function create_backup_sql($file) {
    $line_count = 0;
    $db_connection = $this->db_connect();
    mysql_select_db ($this->db_name()) or exit();
    $tables = mysql_list_tables($this->db_name());
    $sql_string = NULL;
	
	$sql_string.="DELETE FROM `c_award` WHERE 1;\n ALTER TABLE c_award AUTO_INCREMENT=1; \n";
	$sql_string.="DELETE FROM `c_award_type` WHERE 1;\n ALTER TABLE c_award_type AUTO_INCREMENT=1; \n";
	$sql_string.="DELETE FROM `c_battle_soldier` WHERE 1;\n ALTER TABLE c_battle_soldier AUTO_INCREMENT=1; \n";
	$sql_string.="DELETE FROM `c_battle` WHERE 1;\n ALTER TABLE c_battle AUTO_INCREMENT=1;\n ";
	$sql_string.="DELETE FROM `c_layout` WHERE 1;\n ALTER TABLE c_layout AUTO_INCREMENT=1; \n";
	$sql_string.="DELETE FROM `c_soldier` WHERE 1;\n ALTER TABLE c_soldier AUTO_INCREMENT=1; \n";
	$sql_string.="DELETE FROM `c_nextcamp` WHERE 1;\n ALTER TABLE c_nextcamp AUTO_INCREMENT=1; \n";
	$sql_string.="DELETE FROM `c_campaign` WHERE 1;\n ALTER TABLE c_campaign AUTO_INCREMENT=1; \n";
	$sql_string.="DELETE FROM `c_typemap` WHERE 1;\n ALTER TABLE c_typemap AUTO_INCREMENT=1; \n";
	$sql_string.="DELETE FROM `c_worldmap` WHERE 1;\n ALTER TABLE c_worldmap AUTO_INCREMENT=1;\n ";
	
	
	 $table_query = mysql_query("SELECT * FROM `c_worldmap`");	 	
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {	 
	  
        $sql_string .= "INSERT INTO `c_worldmap` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
       
	}
	
	
	
	
	$table_query = mysql_query("SELECT * FROM `c_typemap`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_typemap` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}
	
	
	
	$table_query = mysql_query("SELECT * FROM `c_campaign`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_campaign` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}
	
	
	$table_query = mysql_query("SELECT * FROM `c_nextcamp`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_nextcamp` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}
	
	
	$table_query = mysql_query("SELECT * FROM `c_soldier`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_soldier` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}
	
	
	$table_query = mysql_query("SELECT * FROM `c_layout`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_layout` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}
	
	
	$table_query = mysql_query("SELECT * FROM `c_battle`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_battle` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}
	
	
	$table_query = mysql_query("SELECT * FROM `c_battle_soldier`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_battle_soldier` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}
	
	
	$table_query = mysql_query("SELECT * FROM `c_award_type`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_award_type` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}

	
	$table_query = mysql_query("SELECT * FROM `c_award`");
     $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO `c_award` VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= "); \n";
        		 
	}
	
	
	fwrite($file, $sql_string);
	if(fwrite) return true;
	else false;
	
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
}
?>