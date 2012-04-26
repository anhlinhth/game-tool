<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Type.php';

class Forms_Type extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Type();
	}
	
	public function validate($action)
	{
		
	}
}
?>
