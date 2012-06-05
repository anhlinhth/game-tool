<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Line.php';

class Forms_Quest_Line extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Quest_Line();
	}
	
	public function validate($action)
	{
		
	}
}
?>
