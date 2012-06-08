<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'models'.DS.'Models_Item.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'object'.DS.'Obj_S_Item.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'shop'.DS.'forms'.DS.'Forms_Item.php';

class shop_ItemController extends BaseController
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
	public function indexAction(){
	try
	{
		$md = new Models_Item();
		$data = $md->getAllItem();
		$this->view->data = $data;
		
		
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
				$id = $this->_request->getParam("ID");					
				$mditem = new Models_Item();
				$mditem->_delete($id);								
				Models_Log::insert($this->view->user->username, "act_delete_Item", $obj->name);
				echo 1;	
			}
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function addAction()
	{
		try
		{		$this->_helper->layout->disableLayout();
				$this->_helper->viewRenderer->setNoRender();				
			if($this->_request->isPost())
			{
							
				$form = new Forms_Item();
				$form->_requestToForm($this);					
				$form->validate(INSERT);				
				$md=new Models_Item();
				
				$md->insert($form->obj);							
				Models_Log::insert($this->view->user->username, "act_add_items", $obj->name);
				echo "1";															
			}
			
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	public function updateAction(){
		try{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			$md = new Models_Item();
			if($this->_request->isPost())// da post du lieu len
				{
					$form= new Forms_Item();
					$form->_requestToForm($this);
					if($md->isExistItem($form->obj->ID)!=0)
					{	echo 1;
						$md->_update($form->obj);
						echo "Update thành công";
					}else{ 
						$md->_insert($form->obj);
						echo "Thêm thành công";
					}
					Models_Log::insert($this->view->user->username, "act_update_Item", $obj->name);
				}
		}
		catch(Exception $ex)
	        {            
				$this->view->errMsg = $ex->getMessage();
				Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	        }			
	}
	public function getAction()
	{
		try
		{
			$md=new Models_Item();
			$arraward = $md->getItem();
			
			$arr = (array)$arraward;
			echo(json_encode($arr));
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	public function checkidAction()
	{
		try
		{
			if($this->_request->isPost())
			{
				$this->_helper->layout->disableLayout();
				$this->_helper->viewRenderer->setNorender();
				$id=$this->_request->getParam('id');
				$md=new Models_Item();			
				$result=$md->checkiditem($id);				
				if($result==1)
				{
					echo(1);					
				}
				else if($result!=1)
				{
					echo(0);
				}
			}
					
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}	
	
	}
}
