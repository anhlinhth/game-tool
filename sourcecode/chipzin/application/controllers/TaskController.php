<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Action.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Target.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task_Target.php';

require_once ROOT_APPLICATION_FORMS.DS.'Forms_Task.php';


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
	public function _getQuestTastClient()
	{
		$md = new Models_Task();
		$Tasks = $md->_filter();
			
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
	
	public function addAction()
	{		
		$this->_helper->layout()->disableLayout();		
		try
		{
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Action.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Task_Client.php';	
			$mdAction = new Models_Action();				
			$mdQuestTC = new Models_Quest_Task_Client();		
			$this->view->arrAction = $mdAction->_getAction();				
			//Hiện ListQuesstTaskClient 
			$this->view->arrQuestTC=$mdQuestTC->_getQuestTaskClient();				
			if($this->_request->isPost())
			{
				$this->_helper->layout->disableLayout();
				$this->_helper->viewRenderer->setNorender();
				//print_r($_POST);
				$mdTask = new Models_Task();
				$obj = new Obj_Task();
				$data = $mdTask->findidTask();
			 	$obj->TaskID=$data[0]->ID;
			    $obj->TaskName = $_POST[TaskName];
			    $obj->TaskString = $_POST[TaskString];
			    $obj->ActionID = $_POST[Action];
			    $obj->Quantity = $_POST[Quantity];
			    $obj->UnlockCoin = $_POST[UnlockCoin];
			    $obj->QTC_ID = $_POST[QuestTC];
			    $obj->QuestID = $_POST[QuestID];
			    
			    $form = new Forms_Task();
			    $form->obj = $obj;
			    $form->validate(INSERT);

				if($_POST[Target]=="TargetType")
			    {
			    	$obj->TargetType = $_POST[TargetType];
			    }
			    else
			    {
			    	$obj->TargetType = "NULL";
			    }
			    $mdTask->_insert($obj);
				if($_POST[Target]!="TargetType")
			    {
					foreach ($_POST[TargetList] as $row)
			    	{
			    		$objTT = new Obj_Task_Target();
			    		$objTT->TargetID = $row;
			    		$objTT->TaskID = $obj->TaskID;
			    		print_r($objTT);
			    		if($objTT->TargetID != "")
			    		{
				    		$mdtt = new Models_Task_Target();
				    		$mdtt->insert($objTT);
			    		}
			    	}
			    }
				
			}
			echo "true";
		}
		catch(Exception $ex)
        {
            $this->view->ojb = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}
	
	public function saveAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		try
		{
			if($this->_request->isPost()){// da post du lieu len
										
				if($_POST[Target]=='TargetType')
				{
					$md = new Models_Task();
					$obj = new Obj_Task();
					
					$obj->TaskID = $_POST[TaskID];
				    $obj->ActionID = $_POST[TaskID];
				    $obj->TaskName = $_POST[TaskName];
				    $obj->TaskString = $_POST[TaskString];
				    $obj->ActionID = $_POST[Action];
				    
				    $obj->Quantity = $_POST[Quantity];
				    $obj->UnlockCoin = $_POST[UnlockCoin];
				    $obj->TargetType = $_POST[TargetType];
				    $obj->QTC_ID = $_POST[QTC_ID];
				    $obj->QuestID = $_POST[QuestID];
				    $form = new Forms_Task();
				    $form->obj = $obj;
				    $form->validate(UPDATE);
					$md->_update($obj);
					require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Target.php';
					$mdTT = new Models_Task_Target();
					$mdTT->delete($_POST[TaskID]);
				}
				else 
				{
					$md = new Models_Task();
					$obj = new Obj_Task();
					$obj->TaskID = $_POST[TaskID];
					$obj->ActionID = $_POST[TaskID];
				    $obj->TaskName = $_POST[TaskName];
				    $obj->TaskString = $_POST[TaskString];
				    $obj->ActionID = $_POST[Action];
				    $obj->Quantity = $_POST[Quantity];
				    $obj->UnlockCoin = $_POST[UnlockCoin];
				    $obj->QTC_ID = $_POST[QTC_ID];
				    $obj->QuestID = $_POST[QuestID];
				    $form = new Forms_Task();
				    $form->obj = $obj;
				    $form->validate(UPDATE);
					$md->_update($obj);
					
					require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task_Target.php';
					require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Target.php';
					$mdTT = new Models_Task_Target();
					$Targetlist = $_POST[TargetList];
					$mdTT->delete($_POST[TaskID]);
					if(!empty($Targetlist)){
						foreach ( $Targetlist as $row)
						{
							$objTT= new Obj_Task_Target();
							$objTT->ID = 'NULL';
							$objTT->TargetID = $row;
							$objTT->TaskID = $_POST[TaskID];
							if($objTT->TargetID != "")
							{
								$mdTT->_insert($objTT);
							}
						}
					}
					
				}
			}
			echo "Thành công";
		}
		catch(Exception $ex)
        {
            $this->view->ojb = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
					
	}
	
	
	
}
?>
