<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Action.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Temp_Target.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_template.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Template.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Temp_Target.php';


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
		
		$md = new Models_template();
		$temp = new Obj_Template();
		$TempID = $md->getID();
		$temp->TaskID = $TempID[0][TaskID];
		$temp->TaskName = $_POST['TaskName'];
		$temp->TaskString = $_POST['TaskString'];
		$temp->DescID = $_POST['DescString'];
		$temp->DescString = $_POST['DescID'];
		$temp->QTC_ID = $_POST['QuestTC'];
		$temp->UnlockCoin = $_POST['UnlockCoin'];
		$temp->Quantity = $_POST['Quantity'];
		$temp->ActionID = $_POST['Action'];
		$temp->QuestID = 0;
		$temp->IconClassName = $_POST[IconClassName];
		$temp->IconPackageName = $_POST[IconPackageName];
		if ($_POST[Target]=="TargetType")
		{
			$temp->TargetType = $_POST[TargetType];
					$md->insert($temp);
		}
		else 
		{
			$md->insert($temp);
			$Targetlist = $_POST[TargetList];
			$mdTT = new Models_Temp_Target();
			$mdTT->delete($_POST[TaskID]);
			if(count($Targetlist)!= 0)
			{
				foreach ( $Targetlist as $row)
				{
					$objTT= new Obj_Temp_Target();
					$objTT->ID = 'NULL';
					$objTT->TargetID = $row;
					$objTT->TaskID = $temp->TaskID;
					if($objTT->TargetID != "")
					{
						$mdTT->_insert($objTT);
					}
				}
			}
		}
		echo "1";
	}
	
	public function indexAction()
	{
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Template.php';
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$md = new Models_template();
			$form= new Forms_Template();
			$form->_requestToForm($this);
			$data = $md->filter($form->obj, "TaskID ASC", ($pageNo - 1)*$items, $items);
			$count = $md->_count(null);
			
			
			$this->view->data = $data;
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	public function editAction()
	{
		if($this->_request->isPost())
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Template.php';
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			
			$form = new Forms_Template();
			$form->_requestToForm($this);								
			$md = new Models_template();	
			$form->obj->QuestID = 0;
			
			$md->_update($form->obj);
			$this->_redirect ("/template/edit/id/".$form->obj->TaskID);
			
		}
		else
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Template.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Q_QTC.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Q_Action.php';
			$id = $this->_request->getParam("id");		
			$md = new Models_template();
			$this->view->obj = $md->_getByKey($id);
			$mdQTC = new Models_Q_QTC();
			$this->view->arrQuestTC = $mdQTC->_filter();
			$mdAction = new Models_Action();
			$this->view->arrAction = $mdAction->_filter();
		}
	}
	
}
?>
