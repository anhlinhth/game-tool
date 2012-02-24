<?php
require_once ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Detail.php';

class Forms_Quest_Detail extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Quest_Detail();
	}
	
	public function validate($action)
	{
		if(empty($this->obj->NextQuest)){
			$this->obj->NextQuest = NULL;
		}
	}
}
?>
