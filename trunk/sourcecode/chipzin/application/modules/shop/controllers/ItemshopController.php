<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShop.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'forms'.DS.'Forms_ItemShop.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'models'.DS.'Models_Item_Shop.php';
class Shop_ItemshopController extends BaseController
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
		try
		{
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
				
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			$form = new Forms_ItemShop();
			$form->_requestToForm($this);	
			$md=new Models_Item_Shop();
			$searchID=$this->_request->getParam('ID');
			$data = $md->getItemShop();//filter($form->obj, "ID ASC",($pageNo - 1)*$items, $items);
			$count = $md->count($form->obj);
			$this->view->data = $data;
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;
		}	
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
		
	}
	
	public function deleteAction()
	{
		try {
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();										
			if($this->_request->isPost())
			{			
				$id=$this->_request->getParam("id");											
				$md = new Models_Item_Shop();			
				$md->delete($id);									
				Models_Log::insert($this->view->user->username, "act_delete_itemshop", $obj->name);
				echo "1";											
			}
		
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}		
	}
	public function newAction()
	{
		
	}
	public function newrequireAction()
	{
		
	}
	
}
