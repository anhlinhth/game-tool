<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Action.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Target.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_template.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Template.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task_Target.php';


class TemplateController extends BaseController
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
	
	public function saveAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		$temp = new Obj_Template();
		$temp->TaskID = "NULL";
		$temp->TaskName = $_POST['TaskName'];
		$temp->TaskString = $_POST['TaskString'];
		$temp->DescID = $_POST['DescString'];
		$temp->DescString = $_POST['DescID'];
		$temp->QTC_ID = $_POST['QuestTC'];
		$temp->UnlockCoin = $_POST['UnlockCoin'];
		$temp->Quantity = $_POST['Quantity'];
		$temp->ActionID = $_POST['Action'];
		$temp->QuestID = 0;
		$md = new Models_template();
		$md->insert($temp);
		echo "1";
	}
}
?>
