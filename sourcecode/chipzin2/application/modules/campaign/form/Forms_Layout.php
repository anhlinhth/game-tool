<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Layout.php';

class Forms_Layout extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Layout();
	}
	
	public function validate($action)
	{
		
	}
}
?>
