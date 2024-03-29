<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Worldmap.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Worldmap.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_Worldmap.php';

class Campaign_WorldmapController extends BaseController
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
		$pageNo = $this->_request->getParam("page");
		$items = $this->_request->getParam("items");
		if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;	
		$form = new Forms_Worldmap();
		$form->_requestToForm($this);
		$md = new Models_Worldmap();		
		$SearchID=$this->_request->getParam('SearchID');	
		print_r($SearchID);					
		$data = $md->filter($SearchID,"ID ASC",($pageNo - 1)*$items, $items);		
		$count = $md->_count($form->obj);
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
				$id = $this->_request->getParam("ID");
																														
				$mdWorldmap = new Models_Worldmap();
				$count=$mdWorldmap->isExistWolrdmap($id);
				if($count!=0)
				{
					echo 'WorldMap này không thể xóa.Xóa WolrdMap bên campaign trước';
				}
				else
				{				
					$mdWorldmap->_delete($id);									
					Models_Log::insert($this->view->user->username, "act_delete_Worldmap", $obj->name);					
					echo 1;
				}
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
			$md = new Models_Worldmap();			
			if($this->_request->isPost())// da post du lieu len
				{
					
					$form= new Forms_Worldmap();
					$form->_requestToForm($this);					
					if($form->obj->ID!="")
					{						
						$md->_update($form->obj);
						echo "Update thành công";						
					}
					else
					{ 
						$md->_insert($form->obj);
						echo "Thêm WorldMap thành công";
					}
					Models_Log::insert($this->view->user->username, "act_update_Worldmap", $obj->name);
				}
		}
		catch(Exception $ex)
	        {            
				$this->view->errMsg = $ex->getMessage();
				Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	        }			
	}
}

