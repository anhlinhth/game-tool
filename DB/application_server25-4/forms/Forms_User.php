<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_User.php';

class Forms_User extends Forms_Base
{
	public function __construct()
	{
		$this->obj = new Obj_User();
	}
	
	public function requestToForm($controller)
	{
		parent::_requestToForm($controller);
		
		$request = $controller->getRequest();
		$this->obj->password2 = $request->getParam("password2");		
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
			
			if(empty ($this->obj->fullname))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Họ tên không được để trống");
			}
			
			if(empty($this->obj->password) && empty ($this->obj->password));
			elseif($this->obj->password != $this->obj->password2)
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Xác nhận mật khẩu chưa chính xác");
			}			
		}
		else
		{
			if(empty ($this->obj->username))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Tên tài khoản không được để trống");
			}
			
			if(empty ($this->obj->fullname))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Họ tên không được để trống");
			}
			
			if(empty ($this->obj->password))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Mật khẩu không được để trống");
			}
			
			if(empty ($this->obj->password2))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Mật khẩu 2 không được để trống");
			}
			
			if($this->obj->password != $this->obj->password2)
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Xác nhận mật khẩu chưa chính xác");
			}				
		}	
		
		if(empty ($this->obj->group_id))
			{
				array_push($arrCode, Invalid_Argument_Exception::ERR_FIELD_NULL);
				array_push($arrNote, "Vui lòng chọn nhóm");
			}
		
		if(!empty ($arrCode))
				throw new Invalid_Argument_Exception($arrCode, $arrNote);
	}
}