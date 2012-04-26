<?php
require_once ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Template.php';

class Forms_Template extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Template();
	}
	
	public function validate($action)
	{
		
	}
}
?>
