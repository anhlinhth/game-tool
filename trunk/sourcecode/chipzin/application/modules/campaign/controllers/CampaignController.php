<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'models'.DS.'Models_Campaign.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'models'.DS.'Models_WorldMap.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
class Campaign_CampaignController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	///////////////////////
	public function indexAction(){
	try
		{
			require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'form'.DS.'Forms_Campaign.php';
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$md = new Models_Campaign();
			$form= new Forms_Campaign();
			$form->_requestToForm($this);
			$data = $md->_filter($form->obj, "ID ASC", ($pageNo - 1)*$items, $items);
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
	//////////////////////
	public function editAction(){
		
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
				$mdCamp = new Models_Campaign();

				$obj= new Obj_Campaign();
			//	$count=$mdTask->isExist($id);
				
				$mdCamp->delete((int)$id);
				echo "Xóa QuestTask thành công";
				Models_Log::insert($this->view->user->username, "act_delete_Campaign", $obj->name);													
			}
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	
	public function updateworldmapAction(){
	try{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		$id = $this->_request->getParam("id");
		$desc2 = $this->_request->getParam("desc2");	
		$md = new Models_Campaign();	
		$mdw = new Models_WorldMap();
		
		$obj = new Obj_Campaign();
		$obj->ID = $id;
		$obj->Name = $md->fetchname($id);
		$obj->WorldMap = $mdw->searchname($desc2);
		$md->update($obj);
		Models_Log::insert($this->view->user->username, "act_update_Campaign", $obj->name);

		echo "Update thanh cong";	
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	public function updateAction(){
	try{
		$mdw = new Models_WorldMap();
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		$id = $this->_request->getParam("id");
		$desc = $this->_request->getParam("desc");
		$wm = $this->_request->getParam("select");
		$md = new Models_Campaign();	
		$obj = new Obj_Campaign();
		$obj->ID = $id;
		$obj->Name = $desc;
		if($wm==NULL)
		{
			echo "Chưa nhập dữ liệu listbox";
			return;
		}
		else
			$obj->WorldMap = $mdw->searchname($wm);
	
		$md->update($obj);
		Models_Log::insert($this->view->user->username, "act_update_Campaign", $obj->name);
		echo "Update thanh cong";	
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	public function addAction(){
	try{
		$mdw = new Models_WorldMap();	
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		$wm = $_POST[select];
		$desc = $_POST[decs];
		$obj = new Obj_Campaign();
		if($wm==NULL)
		{
			echo "Chưa nhập dữ liệu listbox";
			return;
		}
		else
		$obj->WorldMap = $mdw->searchname($wm);
		$obj->Name = $desc;
		$md = new Models_Campaign();
		try{
			$md->insert($obj);
		}
		catch(Exception $ex)
		{

		}
		Models_Log::insert($this->view->user->username, "act_insert_Campaign", $obj->name);
	}
	catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
}