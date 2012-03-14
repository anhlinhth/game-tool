<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

class Campaign_SoliderController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function indexAction(){
		
	}
	
}


