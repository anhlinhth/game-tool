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

require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'PigManager.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'ItemManager.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_GiftPackage_Detail.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Item.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Line.php';

class QuestLineController extends BaseController
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
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Line.php';
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$md = new Models_Quest_Line();
			$form= new Forms_Quest_Line();
			$form->_requestToForm($this);
			$data = $md->_filter($form->obj, "QuestLineID ASC", ($pageNo - 1)*$items, $items);
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
				$mdQuestLine = new Models_Quest_Line();
				$count=$mdQuestLine->isExistQuestLine($id);
				if($count!=0)
				{
					echo "Bạn không thể xóa QuestLine này vì trong QuestLine có  Quest";
				}
				else
				{
					$mdQuestLine->_delete($id);
				}									
				Models_Log::insert($this->view->user->username, "act_delete_questline", $obj->name);
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
		$desc = $this->_request->getParam("desc");		
		$obj = new Obj_Quest_Line();
		$obj->QuestLineID = $id;
		$obj->QuestLineName = $desc;
		$md = new Models_Quest_Line();
		$md->update($obj);
		echo "Update thanh cong";	
		
	}
	
	public function addAction(){
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		//$id = $this->_request->getParam("id");
		$desc = $this->_request->getParam("desc");
		$obj = new Obj_Quest_Line();
		//$obj->QuestLineID = $id;
		$obj->QuestLineName = $desc;
		$md = new Models_Quest_Line();
		$md->insert($obj);
		echo " Thêm thành công";
	}
	
	public function additemAction()
	{
		
	}
	
	public function pigshopAction()
	{
		
	}
	
	public function itemshopAction()
	{
		
	}
	
	public function deleteitemAction()
	{
		
	}
	
	public function activeAction()
	{
		
	}
	
	private function _getArrEvent()
	{
		
	}
}
?>
