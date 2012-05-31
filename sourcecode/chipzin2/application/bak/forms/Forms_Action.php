<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Action.php';

class Forms_Action extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Action();
	}
	
	public function validate($action)
	{
		
	}
}
?>
