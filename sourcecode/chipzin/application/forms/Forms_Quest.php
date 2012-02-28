<?php
require_once ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest.php';

class Forms_Quest extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Quest();
	}
	
	public function validate($action)
	{
		
	}
}
?>
