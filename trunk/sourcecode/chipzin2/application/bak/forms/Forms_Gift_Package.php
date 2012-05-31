<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_GiftPackage.php';

class Forms_Gift_Package extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_GiftPackage();
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
				array_push($arrNote, "Không cập nhật được");
			}			
		}
		
		if(empty ($this->obj->alias))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Id không được để trống");
		}
		
		if(empty ($this->obj->name))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Tên gói phần thưởng không được để trống");
		}
		
		if(empty ($this->obj->type))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Vui lòng chọn loại gói quà");
		}
		
		if($this->obj->type == GIFT_TYPE_SELLOFF && empty ($this->obj->tag))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Vui lòng nhập đợt bán");
		}
				
		if(!empty ($arrCode))
				throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}
?>
