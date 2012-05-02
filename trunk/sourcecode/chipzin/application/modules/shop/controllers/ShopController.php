<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';


class Shop_ShopController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','update','delete');
	}
	public function preDispatch()
	{
		parent::preDispatch();
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function indexAction()
	{
		
	}
	
}
