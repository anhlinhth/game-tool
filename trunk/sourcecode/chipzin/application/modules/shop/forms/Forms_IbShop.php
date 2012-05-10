<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_S_ibshop.php';

class Forms_IbShop extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_S_ibshop();
	}
	
	public function validate($action)
	{
	}
}
?>
