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
		$arrCode = array();
		$arrNote = array();
		
		if(empty($this->obj->NeedQuest)){
			$this->obj->NeedQuest = NULL;
		}
		if($action == UPDATE)
		{
			if(empty ($this->obj->QuestID))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Không cập nhật được");
			}			
		}
		
		if(empty ($this->obj->QuestName))
		{			
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "QuesName không được để trống<br>");		
		}		
		if(empty($this->obj->QuestString))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "QuestString không được để trống<br>");			
		}
		if(empty($this->obj->QuestGroupString))
		{
			$this->obj->QuestGroupString=NULL;			
		}
		if(empty($this->obj->QuestDescString))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "QuestDescString không được để trống<br>");
		}
		
		if(empty ($this->obj->QuestLineID))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Vui lòng chọn QuestLine<br>");
		}
		if(!empty ($arrCode))
		throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}
?>
