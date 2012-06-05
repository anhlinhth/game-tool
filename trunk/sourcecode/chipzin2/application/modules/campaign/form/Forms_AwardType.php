<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_AwardType.php';

class Forms_AwardType extends Forms_Base
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
