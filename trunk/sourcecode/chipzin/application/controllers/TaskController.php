<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Action.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';


class TaskController extends BaseController
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
	
	public function deleteAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			$id = $this->_request->getParam("id"); //luu y cho nay nen dat id trung csd			
			$md = new Models_Task();
			$md->_delete($id);	
			echo "da xoa TaskID " .$id;
			Models_Log::insert($this->view->user->username, "act_delete_task");
			
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	
	private function _getArrQuest()
	{
		$md = new Models_Task();
		$Tasks = $md->_filter();
		
		$data = array();
		if($Tasks)
		{
			foreach($Tasks as $task)
			{
				$data[] = array(
					'TaskID' => $task->TaskID,
					'TaskName' => $task->TaskName
				);
			}
			
			$this->view->arrTask = $data;
		}
	}	
	
	public function editAction()
	{		
		$this->_helper->layout()->disableLayout();
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Task.php';			
			//require_once ROOT_APPLICATION_FORMS.DS.'Forms_Action.php';
			
			$md = new Models_Task();
			$mdAction = new Models_Action();	
				$id = $this->_request->getParam("id");
				$this->view->mss = $id;
				$this->view->obj = $md->_getByKey($id);
				$this->view->arrAction = $mdAction->_getAction($this->view->obj->ActionID);
				$this->view->objactionname = $mdAction->_getByKey($this->view->obj->ActionID);			
				
			
		}
		catch(Exception $ex)
        {
            $this->view->ojb = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}

	public function newAction()
	{		
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Task.php';			
			//require_once ROOT_APPLICATION_FORMS.DS.'Forms_Action.php';
			
			$md = new Models_Task();
			$mdAction = new Models_Action();	
			$obj = new Obj_Task();
			$id = $this->_request->getParam("id");
			$obj->QuestID = $id;
			$obj->UnlockCoin = 1;//default value
			$obj->Quantity = 1; //default value
			$obj->Quantity = 1;
			$md->_insert($obj);				
			echo "success";
		}
		catch(Exception $ex)
        {
            $this->view->ojb = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}
	public function saveAction()
	{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			if($this->_request->isPost()){// da post du lieu len				
			
				print_r($_POST);
			}
					
	}
	
	
	
}
?>
