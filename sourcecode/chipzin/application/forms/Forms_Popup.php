<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Popup.php';

class Forms_Popup extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_Popup();
	}
	
	public function validate()
	{
		$arrCode = array();
		$arrNote = array();
        
		if(empty ($this->obj->content))
		{
			array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
			array_push($arrNote, "Nội dung không được để trống");
		}
		
		if(!empty ($arrCode))
				throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}
?>
