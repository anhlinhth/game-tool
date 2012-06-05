<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';


class Models_C_import_arr extends Models_Base
{

	function battle($file)
	{
	$arr=require_once($file);

	//
unset($arr['max_turn']);
unset($arr['random_min']);
unset($arr['random_max']);
unset($arr['loseGold']);

return $arr;
	}
	
	function map($file)
	{
	$arr=require_once($file);
	unset($arr['CONFIG_DEFAULT_VALUE']);
	return $arr;
	}
	
	
}