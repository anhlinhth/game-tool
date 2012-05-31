<?php

class User_AuthController extends Base_Controller
{	
	public function loginAction()
	{	
		$this->_helper->layout->disableLayout();
		try
		{
			if($this->_request->isPost())
			{
				$username = trim($this->_request->getParam("username"));
				$password = trim($this->_request->getParam("password"));				
				
				if(empty($username))
				{
					$this->view->errMsg = "Vui lòng nhập tài khoản";
					return;
				}					
				
				if(empty($password))
				{
					$this->view->errMsg = "Vui lòng nhập mật khẩu";
					return;
				}				
					
				$password = md5($password);
				
				Zend_Loader::loadClass("Zend_Auth_Adapter_DbTable");
				$db = Zend_Registry::get("db");
				
				$authAdapter = new Zend_Auth_Adapter_DbTable($db, 'user', 'username', 'password');
				
				$authAdapter->setIdentity($username);
				$authAdapter->setCredential($password);
				
				$auth = Zend_Auth::getInstance();
				$auth->setStorage(new Zend_Auth_Storage_Session("back"));
				$result = $auth->authenticate($authAdapter);
				
				if($result->isValid())
				{
					$data = $authAdapter->getResultRowObject(null, 'password');	
					if(!$data->active)
					{
						$this->view->errMsg = "Tài khoản chưa được kích hoạt";
						return;
					}
					
					$data->groupPrivileges = array();
					
					$mdGroupPrivilege = new User_Model_GroupPrivilege();
					$mdPrivilege = new User_Model_Privilege();
					$objSearch = new User_Object_GroupPrivilege();
					$objSearch->group_id = $data->group_id;
					$groupPrivileges = $mdGroupPrivilege->_filter($objSearch);					
					foreach ($groupPrivileges as $groupPrivilege)
					{
						if($groupPrivilege->status == 1)
						{
							$privilege = $mdPrivilege->_getByKey($groupPrivilege->privilege_id);
							if($privilege)
								$data->groupPrivileges[] = array(
									'controller' => $privilege->controller_name,
									'action'	 => $privilege->action_name
								);
						}						
					}
					
					$auth->getStorage()->write($data);
					
					
					//Models_Log::insert($data->username, "act_login");
					
					if($data->username == 'admin')
						$this->_redirect("/user/user/index");
					else
						$this->_redirect("/{$data->groupPrivileges[0]['controller']}/{$data->groupPrivileges[0]['action']}");						
				}
				else 
				{
					switch ($result->getCode())
					{
						case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
							$this->view->errMsg = "Tài khoản và mật khẩu không chính xác";
							return;							
						case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
							$this->view->errMsg = "Tài khoản và mật khẩu không chính xác";
							return;
						default:
							$this->view->errMsg = "Đăng nhập không thành công";
							return;							
					}
				}
			}
			else
			{				
			}
		}
		catch(Invalid_Argument_Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
		}
		catch(Internal_Error_Exception $ex)
		{
			$this->view->errMsg = "SYSTEM ERROR";
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}	
	}
	
	public function logoutAction()
	{
		$auth = Zend_Auth::getInstance();
		$auth->setStorage(new Zend_Auth_Storage_Session("back"));
		Zend_Session::destroy();
		$this->_redirect("user/auth/login");
	}
	
	public function changepasswordAction()
	{
		try
		{			
			if($this->_request->isPost())
			{				
				$oldPass = $this->_request->getParam("oldpass");
				$newPass = $this->_request->getParam("newpass");
				$newPassRe = $this->_request->getParam("newpass2");
				
				if(empty($oldPass))
					throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_NULL, "Vui lòng nhập mật khẩu hiện tại");
				
				if(empty($newPass))
					throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_NULL, "Vui lòng nhập mật khẩu mới");
					
				if(empty($newPassRe))
					throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_NULL, "Vui lòng xác nhận lại mật khẩu mới");
					
				if($newPass != $newPassRe)
					throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID, "Xác nhận mật khẩu mới không chính xác");
					
				$mdUser = new Models_User();
				$user = $mdUser->_getByKey($this->view->user->id);				
				
				$md5OldPass = md5($oldPass);
				if($md5OldPass != $user->password)
					throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID, "Mật khẩu hiện tại không chính xác");
					
				$user->password = md5($newPass);				
				$mdUser->_update($user);
				
				
				Models_Log::insert($user->username, "act_changepass");
				$this->view->msg = "Đổi mật khẩu thành công";
			}
			else 
			{
				
			}
		}
		catch(Invalid_Argument_Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
		}
		catch(Internal_Error_Exception $ex)
		{
			$this->view->errMsg = "SYSTEM ERROR";
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}	
}