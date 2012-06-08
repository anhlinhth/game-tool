<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'models'.DS.'Models_Shop.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'models'.DS.'Models_Type_Shop.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_Shop.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'forms'.DS.'Forms_Shop.php';

class Shop_ShopController extends BaseController
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
			$md = new Models_Shop();
			
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$form = new Forms_Shop();
			$form->_requestToForm($this);

			$searchID=$this->_request->getParam('ID');
			$data = $md->filter($form->obj, "ID ASC",($pageNo - 1)*$items, $items);
			$dataTypeshop= new Models_Type_Shop();
			$count = $md->count($objSearch->ID);
			$this->view->datatype=$dataTypeshop-> getTypeShop();			
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
	public function shopmanagerAction()
	{
		try
		{
			$id = $this->_request->getParam("id");
			$md = new Models_Shop();
			$data = $md->getItemshop($id);
			$this->view->data = $data;
			$this->view->idshop = $id;
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	public function getitemshopAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$id=$this->_request->getParam('id');
			$md = new Models_Shop();
			$return = $md->getItemshopByid($id);
			echo(json_encode($return));
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	public function edititemAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$id=$_POST['id'];
			$iditem =$_POST['iditem'];
			$md = new Models_Shop();
			$md->editshopitem($id, $iditem);
			Models_Log::insert($this->view->user->username, "act_edit_item_shop");
			echo('1');
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	public function deleteitemAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$id=$_POST['id'];
			$md = new Models_Shop();
			$md->deleteshopitem($id);
			Models_Log::insert($this->view->user->username, "act_delete_item_shop");
			echo('1');
		}
		catch (Exception $ex)
		{
			echo ($ex->getMessage());
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	public function getlistitemshopAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$id=$this->_request->getParam('id');
			$md = new Models_Shop();
			$return = $md->getlistitemshop();
			echo(json_encode($return));
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	public function newitemshopAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$iditem = $_POST['iditem'];
			$idshop = $_POST['idshop'];
			$md = new Models_Shop();

			$id = $md->newshopitem($iditem, $idshop);
			echo ($id);
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	public function updatetypeshopAction()
	{
	try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			if($this->_request->isPost())
			{
				$idshop=$this->_request->getParam('idshop');
				$idtypeshop=$this->_request->getParam('idtype');
				$md = new Models_Shop();
				$md->updateTypeShop($idshop, $idtypeshop);
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
			$mdTypeShop = new Models_Type_Shop();
			$this->view->typeshop = $mdTypeShop->getTypeShop();
			if($this->_request->isPost())
			{
				$form = new Forms_Shop();
				$form->_requestToForm($this);
				$form->validate(INSERT);
				$md = new Models_Shop();
				$md->addShop($form->obj);
				$lastID = $md->lastInsert();
				
				Models_Log::insert($this->view->user->username, "act_add_shop");
				$this->view->msg='Thêm thành công';	
				$this->_redirect('shop/shop/shopmanager/id/'.$lastID);						
			}
		}
		catch (Exception $ex)
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
			$this->_helper->viewRenderer->setNoRender();
			if($this->_request->isPost())		
			{
				$id = $this->_request->getParam('id');
				$md = new Models_Shop();
				$md->delete($id);
				Models_Log::insert($this->view->user->username, "act_delete_shop");
				echo "1";
			}
		}
		catch (Exception $ex)
		{
				
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
}