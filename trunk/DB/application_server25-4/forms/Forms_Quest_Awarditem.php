<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Awarditem.php';

class Forms_Quest_Awarditem extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Quest_Awarditem();
	}
	
	public function validate($action)
	{
		$arrCode = array();
		$arrNote = array();
		
		if(empty($this->obj->ID)){
			$this->obj->ID = NULL;
		}
		if($action == INSERT)
		{
			if(empty ($this->obj->ID))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Không cập nhật được");
			}			
		}
		
		if(empty ($this->obj->AwardItem))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "AwardItem không được để trống<br>");
		}
				
		if(!empty ($arrCode))
		throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}
?>
