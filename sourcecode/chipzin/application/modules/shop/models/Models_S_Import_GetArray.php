<?php


class Models_S_Import_GetArray {
	function prepareJSON($input) {
		
		//This will convert ASCII/ISO-8859-1 to UTF-8.
		//Be careful with the third parameter (encoding detect list), because
		//if set wrong, some input encodings will get garincluding UTF-8!bled ()
		$imput = mb_convert_encoding ( $input, 'UTF-8', 'ASCII,UTF-8,ISO-8859-1' );
		
		//Remove UTF-8 BOM if present, json_decode() does not like it.
		if (substr ( $input, 0, 3 ) == pack ( "CCC", 0xEF, 0xBB, 0xBF ))
			$input = substr ( $input, 3 );
		
		return $input;
	}
	function shop($path) {
		
		$data = null;		
			
			$myFile = file_get_contents ( $path );
			$myDataArr = json_decode ( $this->prepareJSON ( $myFile ), true );
			$data = $myDataArr;
		return $data;	
	}
	
	function item()
	{
		$arr=array();
		$path=ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_import' . DS;
		$config= require_once ($path.'config_import.php');
		//print_r($config['phpexe'].' '.'"'. $path.'import2.php"');die();
		system ($config['phpexe'].' '.'"'. $path.'import2.php"');
			$file = $path. $config['tofile'];
			if (! empty ( $file )) {
				
				$arrDefine = require_once ($file);
				
				foreach ($arrDefine as $key => $value)
				{
					foreach ( $config ['prefix'] as  $vl ) 
					{
						if (strpos ( $key, $vl ) !== false) 
						{
							$arr[$key]=$value;
						}
					}
				}
							
			}		
		return $arr;
	}
	
	function hero($path)
	{
		$data = null;		
			
			$data = require_once( $path );
			unset($data['CONFIG_DEFAULT_VALUE']);
		return $data;	
	}
	
	function soldier($path)
	{
		$data = null;		
			
			$data = require_once( $path );
			unset($data['CONFIG_DEFAULT_VALUE']);
			return $data;	
	}
}
?>