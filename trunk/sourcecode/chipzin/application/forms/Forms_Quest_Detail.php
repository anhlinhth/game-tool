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
			array_push($arrNote, "QuestName không được để trống");
		}
		
		if(empty ($this->obj->AwardGold))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Phần thưởng Gold không được để trống");
		}
		if(is_integer($this->obj->AwardGold))
		{
	
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Phần thưởng Gold phai là số");
		}
		if(empty ($this->obj->AwardExp))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Vui lòng nhập phần thưởng kinh nghiệm");
		}
		
		if(empty ($this->obj->QuestLineID))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Vui lòng chọn QuestLine");
		}
		if(!empty ($arrCode))
		throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}
?>
