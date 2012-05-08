<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShop.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_ItemShopRequire.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'forms'.DS.'Forms_ItemShop.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'models'.DS.'Models_Item_Shop.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'models'.DS.'Models_Item_Shop_Require.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'models'.DS.'Models_Item_Shop_Unblock.php';
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

			$form = new Forms_ItemShop();
			$form->_requestToForm($this);	
			$md=new Models_Item_Shop();
			$searchID=$this->_request->getParam('ID');

			$data = $md->filter($form->obj, "ID ASC",($pageNo - 1)*$items, $items);
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
		try 
		{						
			$mdKind=new Models_Item_Shop();
			$this->view->maxid=$mdKind->getMaxId();
			$id=$mdKind->getMaxId();
			$this->view->kind=$mdKind->getKind();
			$this->view->require=$mdKind->getRequire();
			$this->view->unblock=$mdKind->getUnblock();
			$this->view->item=$mdKind->getItem();
			
			if($this->_request->isPost())
			{												
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender();	
				$form=new Forms_ItemShop();
				$form->_requestToForm($this);
				$md=new Models_Item_Shop();
				$entity=$this->_request->getParam('Entity');
				$item=$this->_request->getParam('Item');
				if(isset($entity))
				{
					$form->obj->Item=null;					
					$md->insert($form->obj);
				}
				else
				{ 
					$form->obj->Entity=null;					
					$md->insert($form->obj);
				}
				/////////
				$requireData=$this->_request->getParam('itemshoprequire');
				$requireValue=$this->_request->getParam('valuerequire');
				$unblockData=$this->_request->getParam('itemunblock');
				$UnblockValue=$this->_request->getParam('valueunblock');
				$mdRQ=new Models_Item_Shop_Require();
				$mdUB=new Models_Item_Shop_Unblock();
				/////
				
				if(!empty($requireData))
				{
					foreach($requireData as $key=>$value)
					{
						if(!empty($requireValue[$key]))
						{
							$objRequire=new Obj_Base();
							$objRequire->ItemShopID=$id;
							$objRequire->TypeRequire=$value;
							$objRequire->Value = $requireValue[$key];														
							$mdRQ->_insert($objRequire);
									
						}
					}
				}				
				if(!empty($unblockData) )
				{
					foreach($unblockData as $key=>$value)
					{
						if(!empty($UnblockValue[$key]))
						{
							$objUnbock=new Obj_Base();
							$objUnbock->ItemShopID=$id;
							$objUnbock->TypeUnblockID=$value;
							$objUnbock->Value=$UnblockValue[$key];																				
							$mdUB->_insert($objUnbock);							
							
						}
					}
				}				
				
				echo "1";	
			}
			
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}	
	
	public function editAction()
	{
		try 
		{
			
			
			if($this->_request->isPost())
			{
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender();
				$id=$this->_request->getParam('ID');
				$md=new Models_Item_Shop();			
				$form=new Forms_ItemShop();
				$form->_requestToForm($this);			
				$entity=$this->_request->getParam('Entity');
				$item=$this->_request->getParam('Item');
				
				if(isset($entity))
				{
					$form->obj->Item=null;					
					$md->update($form->obj);
				}
				else
				{ 
					$form->obj->Entity=null;					
					$md->update($form->obj);
				}
				/////////
				$requireData=$this->_request->getParam('itemrequire');
				$requireValue=$this->_request->getParam('valuerequire');
				$unblockData=$this->_request->getParam('itemunblock');
				$unblockValue=$this->_request->getParam('valueunblock');
				$mdRQ=new Models_Item_Shop_Require();
				
				
				/////
				
				if(!empty($requireData))
				{
					$mdRQ->delete($id);
					foreach($requireData as $key=>$value)
					{
						if(!empty($requireValue[$key])&& $requireValue[$key]!=0)
						{
							$objRequire=new Obj_Base();
							$objRequire->ItemShopID=$id;
							$objRequire->TypeRequire=$value;
							$objRequire->Value = $requireValue[$key];														
							$mdRQ->_insert($objRequire);
									
						}
					}
				}	
				$mdUB=new Models_Item_Shop_Unblock();
				
				if(!empty($unblockData))
				{
					$mdUB->delete($id);	
					foreach($unblockData as $key=>$value)
					{
						if(!empty($unblockValue[$key]))
						{
							$objUnbock=new Obj_Base();
							$objUnbock->ItemShopID=$id;
							$objUnbock->TypeUnblockID=$value;
							$objUnbock->Value=$unblockValue[$key];
							$mdUB->_insert($objUnbock);
							
						}
					}
				}	
				echo "1";				
				
				
						
			}
			else {
				$md=new Models_Item_Shop();	
				$id=$this->_request->getParam('id');	
				$this->view->obj=$md->_getByKey($id);	
				$this->view->require=$md->getRequire();
				$this->view->requireById=$md->getRequireByID($id);
				$this->view->unblock=$md->getUnblock();
				$this->view->unblockById=$md->getUnblockById($id);
				$this->view->items=$md->getItem();
				$this->view->kind=$md->getKind();
			}			
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());	
		}
	}
	
}
