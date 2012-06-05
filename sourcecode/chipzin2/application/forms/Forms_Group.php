<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Group.php';

class Forms_Group extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Group();
	}

	public function validate($action)
	{
		$arrCode = array();
		$arrNote = array();
		
		if($action == UPDATE)
		{
			if(empty ($this->obj->id))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Id không tồn tại");
			}			
			elseif($this->obj->id == 1)
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Bạn không thể chỉnh sửa nhóm Admin");
			}
		}
		
		if(empty ($this->obj->name))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Tên nhóm không được để trống");
		}
		
		if(!empty ($arrCode))
				throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}