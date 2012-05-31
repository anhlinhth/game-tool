<?php
require_once ROOT_LIBRARY_EXCEPTION.DS.'gss_exception.php';

class Invalid_Argument_Exception extends Gss_Exception 
{
	const ERR_FIELD_NULL 						= 0 ;
	const ERR_FIELD_INVALID						= 1 ;	

	public function __construct($code , $note)
	{
		$arr_code	= array();
		if (is_array($code))
		{
			$arr_code	 = $code ; // code is array
			$arr_note	 = $note;
		}
		else
		{
			$arr_code[0] = $code ;
			$arr_note[0] = $note ;
		}
		
		$message = "";
		for ($i= 0 ; $i< count($arr_code); $i++ )
		{
			switch ($arr_code[$i])
			{
				case Invalid_Argument_Exception::ERR_FIELD_NULL :
							$message 	.= $arr_note[$i].".;";  break;
				case Invalid_Argument_Exception::ERR_FIELD_INVALID :
							$message 	.= $arr_note[$i].".;"; break;								
				default: 	$message 	.= "unknow error" ;
			}
		}
		parent::__construct($message);
		
	}	
}

