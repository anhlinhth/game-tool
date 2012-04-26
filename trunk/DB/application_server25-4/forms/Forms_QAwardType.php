<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_AwardType.php';


class Forms_QAwardType extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_AwardType();
	}
	
	public function validate($action)
	{
		
	}
}
?>
