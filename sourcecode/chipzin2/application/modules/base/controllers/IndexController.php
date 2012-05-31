<?php
class Test_IndexController extends Base_Controller
{
	public function _setUserPrivileges()
	{
		return array('index');
	}
	public function preDispatch()
	{
		parent::preDispatch();
		//if(!$this->hasPrivilege())
			//$this->_redirect ("/error/permission");
	}
	public function indexAction()
	{
		try{				
			
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}	
	}
}
	