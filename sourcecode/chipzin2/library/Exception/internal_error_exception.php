<?php
require_once ROOT_LIBRARY_EXCEPTION.DS.'gss_exception.php';	

class Internal_Error_Exception extends Gss_Exception 
{	
	public function __construct($message)
	{			
		parent::__construct($message);		
	}	
}