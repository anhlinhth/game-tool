<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Award.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Q_Action.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
		DS . 'Models_Award_type.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Detail.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_NextQuest.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Q_Action.php';

require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';	

class QuestController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','active','updatenextquest','updateneedquest','new','update','import','item','additem','pigshop','itemshop');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	
	
	public function importAction() {
		if ($this->_request->isPost ()) 
		{			
			/*
			//import file json to object
			$file2= ROOT_IMPORT_FILE.'/system.xfj';
			$fileContent = file_get_contents ($file2);
			$arr=json_decode($fileContent);
			var_dump($arr);
			die();
			*/
			//--------------------------------------------------------------------			
			$file11 = $_FILES ['file1'] ;
			$file12 = $_FILES ['file2'] ;
			if($file11!=null )
			{
			
				if($file11['name']=='Define.def.php')	
				{		$dest1File = ROOT_IMPORT_FILE.DS.$file11['name'];
		 move_uploaded_file($file11['tmp_name'], $dest1File);
		 
				}
				
				
			
			}
			if($file12!=null )
			{
				if($file12['name']=='system.xfj')
				{
				
		$dest2File = ROOT_IMPORT_FILE.DS.$file12['name'];
		 move_uploaded_file($file12['tmp_name'], $dest2File);
		 
			}}
		
			
			
			if(file_exists (ROOT_IMPORT_FILE.'/import2.php')==false ||file_exists (ROOT_IMPORT_FILE.'/Define.def.php')==false ) 
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please check files exists in folder import_file_config : Define.def.php and import2.php')
			 </SCRIPT>");
			else {
			system ( '"C:/xampp/php/php.exe" '. ROOT_IMPORT_FILE.'"/import2.php"' );
			$file = ROOT_IMPORT_FILE . '/define.php';
			if (! empty ( $file )) {
				
				$arrDefine = require_once ($file);
				$md_Action=new Models_Q_Action();
				$obj_action= new Obj_Q_Action();
				foreach ( $arrDefine as $key => $value ) 
				{
					if (strpos ( $key, 'QUEST_TASK_' ) !== false) 
					{
						$obj_action->ActionID=(int)$value;
						$obj_action->ActionName=$key;
						if ($md_Action->isExist($obj_action->ActionID))
						{
							$md_Action->Update($obj_action);
						}
						else 
						{
							
							$md_Action->Insert($obj_action);
						}
					
						
					} 
					
				}
				Models_Log::insert($this->view->user->username , "Import action");
			
			}		}
		}
	
	}
	
	public function indexAction()
	{
	try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest.php';
			$this->_getArrQuest();			
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			$form = new Forms_Quest();
			$form->_requestToForm($this);						
			if(empty($form->obj->QuestLineID))
				$form->obj->QuestLineID = NULL;
			
			$md= new Models_Quest();
			$mdqd = new Models_Quest_Detail();
			$md_questLine = new Models_Quest_Line();
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
			$this->view->item = $form->obj;
			
			
			$dataquestlineID = $md->getQuestlineID();
			
			$count = $md->count($form->obj);		
			$this->view->dataquestlineid = $dataquestlineID;
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;
			$this->view->obj = $form->obj;
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
				
	}	
	
	public function editAction()
	{		
		try
		{
		    require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
		    		DS . 'Models_Award_type.php';
			if($this->_request->isPost())// da post du lieu len
			{	
				$this->_helper->layout->disableLayout();
				$this->_helper->viewRenderer->setNoRender();
				
				$form = new Forms_Quest_Detail();
				$form->_requestToForm($this);					
				$form->validate(UPDATE);			
				$md = new Models_Quest_Detail();				
				$md->update($form->obj);
				//////////////////Update Award Item////////////////////////////
				$mdAwardItem = new Models_Quest_Award();
				$mdAwardItem->delete($form->obj->QuestID);
				$arrAwardValue = $_POST['AwardValue'];
				$arrAwardType = $_POST['AwardType'];
				
				if(!empty($arrAwardType))
				{
					foreach($arrAwardType as $key=>$value)
					{
						if(!empty($arrAwardValue[$key])){
							$obj_award = new Obj_Base();
							$obj_award->QuestID = $form->obj->QuestID;
							$obj_award->AwardTypeID = $value;
							$obj_award->Value = $arrAwardValue[$key];													
							$mdAwardItem->_insert($obj_award);
						}
							
					}
				}
				Models_Log::insert($this->view->user->username, "act_update_award_item");
				echo "1";
			}else{		
				$md = new Models_Quest_Detail();
				$mdawartype = new Models_Award_Type();
				$id = $this->_request->getParam("id");
				$this->view->obj = $md->_getByKey($id);				
				$this->view->arrQuestLine = $md->_getQuestLine();
				$this->view->arrNeedQuest = $md->getQuest();
				$this->view->arrAward = $md->getAward($id);
				
				$this->view->arrTask = $md->getTask($id);
				$this->view->arrQuest = $md->getQuest($id);				
				$this->view->arrawardtype = $mdawartype->getAwardtype();
			}	
				
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}
	
	public function newAction()
	{			
		try{
			//Lay maxid
			$md_getmax= new Models_Quest();
			$idmax =$md_getmax->getMaxQuestID();
			$id=$idmax+1;			
			$mdawartype = new Models_Award_Type();
			$this->view->arrawardtype = $mdawartype->getAwardtype();
			$md = new Models_Quest_Detail();			
			$this->view->obj = new Obj_Quest_Detail();
			$this->view->obj->QuestID = $id;
			$this->view->obj->QuestLineID=$_SESSION['QuestLine'];

			
			$this->view->arrQuestLine = $md->_getQuestLine();
			$this->view->arrNeedQuest = $md->getQuest();			
			$this->view->arrTask = $md->getTask($id);
			$this->view->arrQuest = $md->getQuest($id);	
			if($this->_request->isPost())
			{
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender();	
				
				$form = new Forms_Quest_Detail();
				$form->_requestToForm($this);	
				$_SESSION['QuestLine']=$form->obj->QuestLineID;				
				$form->validate(INSERT);
				$md = new Models_Quest_Detail();
							
				$questID = $md->_insert($form->obj);
				//$form->obj->QuestID = $questID;
				//$obj_nextquest = new Obj_Quest_NextQuest();
				//$obj_nextquest->QuestID = $questID;
				//$md->insertNextQuest($obj_nextquest);
				
				Models_Log::insert($this->view->user->username, "act_add_new_quest");
				
				//update quest award
				$arrAwardValue = $_POST[AwardValue];
				$arrAwardType = $_POST[AwardType];
				$mdAwardItem = new Models_Quest_Award();
				//		
				if(!empty($arrAwardType))
				{
					foreach($arrAwardType as $key=>$value)
						{
						    if(!empty($arrAwardValue[$key])){
						        $obj_award = new Obj_Base();
						        $obj_award->QuestID = $questID;
						        $obj_award->AwardTypeID = $value;
						        $obj_award->Value = $arrAwardValue[$key];						        
						        $mdAwardItem->_insert($obj_award);
						    }
							
						}
				}				
				echo '1';
				Models_Log::insert($this->view->user->username, "act_update_AwardItem");		
			}	
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}
	
	public function deleteAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$id = $this->_request->getParam("id"); //luu y cho nay nen dat id trung csd		
			
			$mdquest = new Models_Quest();
			$mdquest->delete($id);
						
			Models_Log::insert($this->view->user->username, "act_delete_quest");
			echo "Xóa thành công";
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	private function _getArrQuest()
	{
		$md = new Models_Quest();
		$Quests = $md->_filter();
		
		$data = array();
		if($Quests)
		{
			foreach($Quests as $quest)
			{
				$data[] = array(
					'QuestID' => $quest->QuestID,
					'QuestName' => $quest->QuestName
				);
			}
			
			$this->view->arrQuest = $data;
		}
	}	
	
	public function listquestAction()
	{		
		try
		{
			$this->_helper->layout->disableLayout();
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest.php';
			$this->_getArrQuest();
			
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			$form = new Forms_Quest();
			$form->_requestToForm($this);	
							
			if(empty($form->obj->QuestLineID))
				$form->obj->QuestLineID = NULL;
			$md= new Models_Quest();
			$mdqd = new Models_Quest_Detail();
			$md_questLine = new Models_Quest_Line();
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
			$this->view->item = $form->obj;
			$this->view->filterQuestLine = $md_questLine->_getByKey($form->obj->QuestLineID);			
			$arrQuest = $md->filter($form->obj, "QuestName ASC", ($pageNo - 1)*$items, $items);
			$arrAllQuest = $mdqd->getQuest();
			$mdQT = new Models_Task();
			$dataTask = $mdQT->listQuestInTask();
			$dataquestlineID = $md->getQuestlineID();
			$dataquestneed=$md->getNeedQuest();
			//print_r($dataquestneed);
			$count = $md->count($form->obj);
			$arrNextQuest = array();
			
			foreach($arrQuest as $quest){
			    $arrNextQuest[$quest->QuestID] = $mdqd->getNextQuest($quest->QuestID);
			};
			
			
			$this->view->arrQuest = $arrQuest;
			$this->view->arrNextQuest = $arrNextQuest;
			$this->view->arrAllQuest= $arrAllQuest;
			$this->view->Task = $dataTask;
			$this->view->dataquestlineid = $dataquestlineID;
			
			
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;
			$this->view->form = $form->obj;
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	
	public function listtaskAction(){
		try
		{
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Action.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Target.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Task_Client.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Template.php';
									
			$this->_helper->layout->disableLayout();			
			$questid = $this->_request->getParam("id");
			$md = new Models_Quest_Detail();
			$mdAction = new Models_Action();				
			$mdQuestTC = new Models_Quest_Task_Client();
			$mdTT = new Models_Task_Target();
			$mdQuestTC = new Models_Quest_Task_Client();
			$mdtemp = new Models_template();
	
			//Hiện List q_action
			$this->view->arrTask = $md->getTask($questid);
						
			$this->view->arrAction = $mdAction->_getAction();
			$this->view->arrTemp = $mdtemp->_filter(null,"TaskName",null,null);
			$this->view->arrTaskTarget = $mdTT->select($questid);
			
			//Hiện ListQuesstTaskClient 
			$this->view->arrQuestTC=$mdQuestTC->_getQuestTaskClient();
			
		}catch(Exception $ex){
			
	           Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	    }		
	}
			
	
	public function updateneedquestAction()
	{
		try{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest.php';
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			if($this->_request->isPost())
			{
				$this->QuestID=$this->_request->getParam('questid');
				$this->NeedQuest=$this->_request->getParam('needquest');
				$form=new Models_Quest();
				$form->updateNeedquest($this->QuestID,$this->NeedQuest);
				$md = new Models_Quest_Detail();				
				Models_Log::insert($this->view->user->username, "act_update_need_quest");			
			}
			echo "1";
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}		
	}
	
	public function updatenextquestAction()
	{
		try{
 			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Detail.php';
			require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_NextQuest.php';
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			if($this->_request->isPost())
			{
			    
			    $action = $_POST['Action'];		    
			    $md = new Models_Quest_Detail();
			    switch ($action) {
			    	case "insert":		
			    	    $questID = $_POST['questID'];
			        	$obj = new Obj_Quest_NextQuest();
			        	$obj->QuestID = $questID;
			        	$obj->NextQuest = null;
			       	 	$md->insertNextQuest($obj);
			       	 	echo "1";
			      	break;
			    	case "delete":
			    	    $id = $_POST['ID'];
			    		$md->deleteNextQuest($id);
			    		echo "1";
			    	break;
			    	case "update":			    	   
			    		$obj->ID = $_POST['ID'];
			    		$obj->QuestID = $_POST['QuestID'];
			    		$obj->NextQuest = $_POST['NextQuest'];	
			    		if(empty($obj->NextQuest)){
			    		  $obj->NextQuest = null;  
			    		}	    		
			    		$md->updateNextQuest($obj);
			    		echo "1";
			    		break;
			    	default:			    		
			    	break;
			    }
// 			    if($action == 'insert'){
			        
			        
// 			    }else if($ac){
// 			        $this->QuestID=$this->_request->getParam('questid');
// 			        $this->NextQuest=$this->_request->getParam('nextquest');
// 			        if(empty($this->NextQuest))
// 			        {
// 			        	$this->NextQuest = "NULL";
// 			        }
// 			        $form=new Models_Quest();
// 			        $form->updateNextquest($this->QuestID,$this->NextQuest);
// 			    }
				
				Models_Log::insert($this->view->user->username, "act_update_next_quest");
			}
			
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}		
	}
	public function updateAction()
	{
		try
		{			
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Awarditem.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Needquest.php';
			require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Awarditem.php';
			require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Needquest.php';
			require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';
		
			if($this->_request->isPost())// da post du lieu len
			{	
				$this->QuestID= $this->_request->getParam("QuestID");
				$form = new Forms_Quest_Detail();
				$form->_requestToForm($this);				
				$form->validate(UPDATE);
				$md = new Models_Quest_Detail();
			//	print_r($form->obj);
				$md->_update($form->obj);
				
				//update quest need quest
				$this->arrNeedQuest = $this->_request->getParam("need-quest");
				$mdNeedQuest = new Models_Quest_Needquest();
				$mdNeedQuest->_delete($this->QuestID);
				foreach($this->arrNeedQuest as $i=>$key)
				{
					$objneedquest = new Obj_Quest_Needquest();
					$objneedquest->QuestID = $this->QuestID;
					$objneedquest->NeedQuest = $this->arrNeedQuest[$i];
					
					if($objneedquest->NeedQuest != "")
					{
						$mdNeedQuest->_insert($objneedquest);
					}
				}
				Models_Log::insert($this->view->user->username, "act_update_needquest");
				
				//update quest awarditem
				$this->AwardItem = $this->_request->getParam("awarditem");
				$mdAwardItem = new Models_Quest_Awarditem();
				$mdAwardItem->_delete($this->QuestID);
				foreach($this->AwardItem as $i=>$key)
				{
					$objAwardItem = new Obj_Quest_Awarditem();
					$objAwardItem->QuestID = $this->QuestID;
					$objAwardItem->AwardItem = $this->AwardItem[$i];
					
					if($objAwardItem->AwardItem != "")
					{
						$mdAwardItem->_insert($objAwardItem);
					}
				}
				Models_Log::insert($this->view->user->username, "act_update_AwardItem");
				
				//update task
				$this->arrTaskID= $this->_request->getParam("TaskID");			
				$this->arrTaskName= $this->_request->getParam("TaskName");		
				$this->arrTaskString= $this->_request->getParam("TaskString"); 
				$this->arrDescID= $this->_request->getParam("DescID");
				$this->arrQTC_ID= $this->_request->getParam("QTC_ID");
				$this->arrUnlockCoin= $this->_request->getParam("UnlockCoin");
				$this->arrIconClassName= $this->_request->getParam("IconClassName");
				$this->arrQuantity= $this->_request->getParam("Quantity");
				$this->arrActionID= $this->_request->getParam("Action");
				$this->arrTargetID= $this->_request->getParam("TargetID");
				
				foreach($this->arrTaskID as $i=>$key)
				{
					$task = new Obj_Task();
					$task->TaskID = $this->arrTaskID[$i];
					$task->TaskName = $this->arrTaskName[$i];
					$task->TaskString = $this->arrTaskString[$i];
					$task->DescID = $this->arrDescID[$i];
					$task->QTC_ID = $this->arrQTC_ID[$i];
					$task->UnlockCoin = $this->arrUnlockCoin[$i];
					$task->IconClassName = $this->arrIconClassName[$i];
					$task->Quantity = $this->arrQuantity[$i];
					$task->ActionID = $this->arrActionID[$i];
					$task->QuestID = $this->QuestID;
					$task->TargetID = $this->arrTargetID[$i];

					$mdtask = new Models_Task();
					if($task->TaskID == "")
					{
						$task->TaskID = $mdtask->findid();
						$mdtask->_insert($task);
						Models_Log::insert($this->view->user->username, "act_insert_task");
					}
					else
					{
						$mdtask->_update($task);
						Models_Log::insert($this->view->user->username, "act_update_task");
					}				
				}
				$this->_redirect("/quest/index");
			}
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}
	}
	