<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Q_QTC.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Q_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Q_QTC.php';

class QTCController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','update');
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
			
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Q_QTC.php';
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$md = new Models_Q_QTC();
			$form= new Forms_Q_QTC();
			$form->_requestToForm($this);
			$data = $md->_filter($form->obj, "QTC_ID ASC", ($pageNo - 1)*$items, $items);
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
				$mdTask = new Models_Q_Task();
				$mdQTC=new Models_Q_QTC();
				$objQTC= new Obj_Q_QTC();
				$count=$mdTask->isExist($id);
				if($count!=0)
				{
					echo "Bạn không thể xóa Quest Task Client này vì trong Task có  Quest Task Client";
				}
				else
				{					
					$mdQTC->delete((int)$id);
					Models_Log::insert($this->view->user->username, "act_delete_QTC", $obj->name);
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
		$id = $this->_request->getParam("id");
		$desc = $this->_request->getParam("desc");		
		$obj = new Obj_Q_QTC();
		$obj->QTC_ID = $id;
		$obj->QTC_Name = $desc;
		$md = new Models_Q_QTC();
		$md->update($obj);
		Models_Log::insert($this->view->user->username, "act_update_QTC", $obj->name);

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
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		//$id = $this->_request->getParam("id");
		$desc = $this->_request->getParam("desc");
		$obj = new Obj_Q_QTC();
		//$obj->QTC_Name = $id;
		$obj->QTC_Name = $desc;
		$md = new Models_Q_QTC();
		$md->insert($obj);
		Models_Log::insert($this->view->user->username, "act_insert_QTC", $obj->name);

		echo " Thêm thành công";
	}
	catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	
}
?>
