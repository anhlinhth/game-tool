<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Gift_Package_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Event.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item_Increment.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Action_New.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'PigManager.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'ItemManager.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_GiftPackage_Detail.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Item.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Action.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Line.php';

class ActionController extends BaseController
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
	
	public function indexAction()
	{
	try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Action.php';
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$md = new Models_Action_New();
			$form= new Forms_Action();
			$form->_requestToForm($this);
			$data = $md->_filter($form->obj, "ActionID ASC", ($pageNo - 1)*$items, $items);
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
	
	public function deleteAction()
	{
	try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			
			if($this->_request->isPost())
			{				
				$id = $this->_request->getParam("id");								
				$mdQuestLine = new Models_Action_New();
				$count=$mdQuestLine->isExistAction($id);
				var_dump($count);
				if($count!=0)
				{
					echo "rtrrrr";
				}
				else
				{
					$mdQuestLine->_delete($id);
				}									
				Models_Log::insert($this->view->user->username, "act_delete_action", $obj->name);
			}
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	
	public function updateAction(){
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		$id = $this->_request->getParam("id");
		$desc = $this->_request->getParam("desc1");		
		$obj = new Obj_Action();
		$obj->ActionID = $id;
		$obj->ActionName = $desc;
		
	//	var_dump($obj);
		$md = new Models_Action_New();
		$md->update($obj);
		echo "Update thành công";	
		
	}
	
	public function addAction(){
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		$id = $this->_request->getParam("id");
		$desc = $this->_request->getParam("desc1");
		$obj = new Obj_Action();
		$obj->ActionID = $id;
		$obj->ActionName = $desc;
		$md = new Models_Action_New();
		$md->insert($obj);
		echo " Thêm thành công";
	}
	
}
?>
