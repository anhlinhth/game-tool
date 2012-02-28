<?php
function url(){
  $protocol = $_SERVER['HTTPS'] ? "https" : "http";
  return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
if (!defined("C5_EXECUTE")) {
		define('C5_EXECUTE', true);
	} 
$pageURL = '';
$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
define('HTTP_SERVER', $pageURL);
?>