<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShop.php';

class Forms_ItemShop extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_ItemShop();
	}
	
	public function validate($action)
	{
		
	}
}
?>
