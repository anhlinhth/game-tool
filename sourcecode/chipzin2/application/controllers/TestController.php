<?php
class TestController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','active','item','additem','pigshop','itemshop');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	
	public function testpostAction(){
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		print_r($_POST);			
	}
	
	public function indexAction(){
				
	}
}
?>
