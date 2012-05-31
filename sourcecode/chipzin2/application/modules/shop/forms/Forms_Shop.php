<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_Shop.php';

class Forms_Shop extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Shop();
	}
	
	public function validate($action)
	{
		
	}
}
?>
