<?php
require_once ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';

class Forms_Task extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Task();
	}
	
	public function validate($action)
	{
		$arrCode = array();
		$arrNote = array();
		
		if(empty($this->obj->TaskID)){
			$this->obj->TaskID = NULL;
		}
		if($action == UPDATE)
		{
			if(empty ($this->obj->TaskID))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Không cập nhật được");
			}			
		}
		if($action == INSERT)
		{
			if(empty ($this->obj->TaskID))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Không thêm mới được");
			}			
		}
		if(empty ($this->obj->UnlockCoin))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);			
			array_push($arrNote, "UnlockCoin không được để trống<br>");
		}		
		
		if(!ctype_digit($this->obj->UnlockCoin))
		{	
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_INVALID);
			array_push($arrNote, "UnlockCoin phải là số<br>");
		}
				
		if(empty ($this->obj->Quantity))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Quantity không được để trống<br>");
		}

		if(!ctype_digit($this->obj->Quantity))
		{	
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_INVALID);
			array_push($arrNote, "Quantity phải là số<br>");
		}
		

		
		if(!empty ($arrCode))
		throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}
?>
