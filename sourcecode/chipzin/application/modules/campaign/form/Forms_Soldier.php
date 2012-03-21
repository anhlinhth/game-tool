<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Soldier.php';

class Forms_Soldier extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Soldier();
	}
	
	public function validate($action)
	{
		
	}
}
?>
