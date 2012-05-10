<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_S_ibshop_item.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'models'.DS.'Models_Ib_Shop.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'forms'.DS.'Forms_IbShop.php';

class Shop_IbshopController extends BaseController
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
			$form = new Forms_IbShop();
			$form->_requestToForm($this);
			$md = new Models_Ib_Shop();
			$this->view->dataindex=$md->getTabIndex();
			$searchID=$this->_request->getParam('ID');		
			$data = $md->filter($form->obj,"TabIndex ASC",($pageNo - 1)*$items, $items);
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
				$md = new Models_Ib_Shop();			
				$md->delete($id);									
				Models_Log::insert($this->view->user->username, "act_delete_ibshop", $obj->name);
				echo "1";											
			}
		
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}		
	} 
	
	public function updatetabindexAction()
	{
		try {
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();													
			if($this->_request->isPost())
			{				
				
				$array=$this->_request->getParam('arrayorder');
				$md=new Models_Ib_Shop();
				$count=1;
				foreach($array as $row)
				{				
						
					$md->updateIndex($count, $row['TabIndex']);
					$count++;
				}	
				echo "Update Order thành công.Refresh lại trang ";					
												
				Models_Log::insert($this->view->user->username, "act_update_ibshop", $obj->name);
													
			}
		
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}		
	}
	
}
