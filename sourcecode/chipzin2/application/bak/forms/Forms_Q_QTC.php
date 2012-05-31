<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Q_QTC.php';

class Forms_Q_QTC extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Q_QTC();
	}
	
	public function validate($action)
	{
		
	}
}
?>