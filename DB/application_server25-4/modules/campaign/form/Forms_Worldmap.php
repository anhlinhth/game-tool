<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Worldmap.php';

class Forms_Worldmap extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Worldmap();
	}
	
	public function validate($action)
	{
		
	}
}
?>
