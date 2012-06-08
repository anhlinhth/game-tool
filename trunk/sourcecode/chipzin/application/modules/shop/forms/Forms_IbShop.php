<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_S_ibshop.php';

class Forms_IbShop extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_S_ibshop();
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
		
		if(!empty($this->obj->Name))
		{			
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Name không được để trống<br>");		
		}		
				
		if(!empty ($arrCode))
		throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}
?>
