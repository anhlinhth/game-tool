<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_S_item.php';

class Forms_Item extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_S_item();
	}
	
	public function validate($action)
	{
		
	}
}
?>
