<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Action.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Target.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task_Target.php';


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
}
?>
