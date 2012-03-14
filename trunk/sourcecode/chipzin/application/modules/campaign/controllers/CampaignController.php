<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Campaign.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

class Campaign_CampaignController extends BaseController
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
	///////////////////////
	public function indexAction(){
		$md = new Models_Campaign();
		echo $md->get();
	}
	//////////////////////
	public function editAction(){
		
	}
	
}
	
	

?>


