<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShop.php';

class Forms_ItemShop extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_ItemShop();
	}
	
	public function validate($action)
	{
		$arrCode = array();
		$arrNote = array();
		
		
		if($action == UPDATE)
		{
			if(empty ($this->obj->ID))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Không cập nhật được");
			}			
		}
		
		if(empty ($this->obj->Title))
		{			
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Title không được để trống<br>");		
		}		
		
		if(empty($this->obj->Level))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Level không được để trống<br>");		
		}		
		
		if(!ctype_digit($this->obj->Level))
		{	
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_INVALID);
			array_push($arrNote, "Level phải là số<br>");
		}		
		if(!empty ($arrCode))
		throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}
?>
