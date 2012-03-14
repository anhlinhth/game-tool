<?php
require_once ROOT_LIBRARY_EXCEPTION.DS.'invalid_arguments_exception.php';
require_once ROOT_LIBRARY_EXCEPTION.DS.'internal_error_exception.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

class BaseController extends Zend_Controller_Action
{
	public function init()
	{
		$request = $this->getRequest();
		$this->view->baseUrl 		= $request->getBaseUrl();
		$this->view->controllerName = $request->getControllerName();
		$this->view->actionName		= $request->getActionName();
		
		$auth = Zend_Auth::getInstance();
		$auth->setStorage(new Zend_Auth_Storage_Session("back"));
		$this->view->user = $auth->getIdentity();
		$this->view->arrParam = $this->_request->getParams();		
	}
	
	public function preDispatch()
	{
		$auth = Zend_Auth::getInstance();
		$auth->setStorage(new Zend_Auth_Storage_Session("back"));
		if(!$auth->hasIdentity())
		{
			if($this->view->controllerName != 'auth' || ($this->view->controllerName == 'auth' && $this->view->actionName != 'login'))			{
				
				$this->_redirect("auth/login");
			}
		}
	}
	
	public function hasPrivilege()
	{
		if($this->view->user->group_id == 1)
			return 1;
		
		foreach($this->view->user->groupPrivileges as $privilege)
		{
			if($privilege['controller'] == $this->view->controllerName && $privilege['action'] == $this->view->actionName)
				return 1;
		}
		
		return 0;
	}
}