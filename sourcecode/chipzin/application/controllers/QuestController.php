<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Needquest.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Awarditem.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Q_Action.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Detail.php';
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
			
			if(file_exists (ROOT_IMPORT_FILE.'/import2.php')==false ||file_exists (ROOT_IMPORT_FILE.'/Define.def.php')==false ) 
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please check files exists in folder import_file_config : Define.def.php and import2.php')
			 </SCRIPT>");
			else {
			system ( '"D:/003/xampp/php/php.exe" '. ROOT_IMPORT_FILE.'"/import2.php"' );
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

			$md= new Models_Quest();
			$md_questLine = new Models_Quest_Line();
			
			$this->view->item = $form->obj;
			$this->view->filterQuestLine = $md_questLine->_getByKey($form->obj->QuestLineID);			
			$data = $md->filter($form->obj, "QuestID ASC", ($pageNo - 1)*$items, $items);
			$dataquestlineID = $md->getQuestlineID();
			$dataquestneed=$md->getNeedQuest();
			//print_r($dataquestneed);
			$count = $md->count($form->obj);
			
			$this->view->data = $data;
			$this->view->data2=$data;
			$this->view->dataquestlineid = $dataquestlineID;
			
			
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;
			
			/*if($this->_request->getParam("hidSync"))
			{
				$location = $this->_request->getParam("hidLocation");
				
				$data = $md->_filter(null, "id DESC", 0, 0);
				
				$mdSaleOffShop = new Models_SaleOff_Shop();
				$saleOffData = $mdSaleOffShop->_filter();
				$mdItem = new Models_Item();
				$items = $mdItem->_filter();
				
				$md->sync($data,$items,$saleOffData,$location);
				$this->view->msg = "Sync dữ liệu thành công";
			}
			*/
			$this->view->form = $form->obj;
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
					
			$md = new Models_Quest_Detail();
			$id = $this->_request->getParam("id");
				$this->view->obj = $md->_getByKey($id);				
				$this->view->arrQuestLine = $md->_getQuestLine();
				$this->view->arrNeedQuest = $md->getQuest();
				$this->view->arrAwardItems = $md->getAwardItems($id);
				$this->view->arrTask = $md->getTask($id);
				$this->view->arrQuest = $md->getQuest($id);	
				
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}
	
	public function newAction()
	{	
		
		try
		{
			//Lay maxid
			$md_getmax= new Models_Quest();
			$idmax =$md_getmax->getMaxQuestID();
			$id=$idmax+1;
			$md = new Models_Quest_Detail();			
			$this->view->obj = new Obj_Quest_Detail();
			$this->view->obj->QuestID = $id;			
			$this->view->arrQuestLine = $md->_getQuestLine();
			$this->view->arrNeedQuest = $md->getQuest();
			$this->view->arrAwardItems = $md->getAwardItems($id);
			$this->view->arrTask = $md->getTask($id);
			$this->view->arrQuest = $md->getQuest($id);	
			if($this->_request->isPost())
			{
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender();	
				$form = new Forms_Quest_Detail();
				$form->_requestToForm($this);					
				$form->validate(INSERT);
				$md = new Models_Quest_Detail();			
				$md->_insert($form->obj);
				$this->QuestID= $form->obj->QuestID;
				
				Models_Log::insert($this->view->user->username, "act_add_new_quest");
				
				//update quest awarditem
				$this->AwardItem = $this->_request->getParam("additem");
				$mdAwardItem = new Models_Quest_Awarditem();
				$mdAwardItem->_delete($this->QuestID);
				if(!empty($this->AwardItem)){
					foreach($this->AwardItem as $i=>$key)
						{
							$objAwardItem = new Obj_Quest_Awarditem();
							$objAwardItem->ID="NULL";
							$objAwardItem->QuestID = $this->QuestID;
							$objAwardItem->AwardItem = $this->AwardItem[$i];
							
							if($objAwardItem->AwardItem != "")
							{
								$mdAwardItem->_insert($objAwardItem);
							}
						}
				}
				
				echo '1';
				Models_Log::insert($this->view->user->username, "act_update_AwardItem");
				//$this->view->msg = "them thanh cong";
				
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
			echo "1";
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
			
			
			if($this->_request->isPost())// da post du lieu len
			{				
				
				//$this->_helper->viewRenderer->setNoRender();
				$this->_helper->layout->disableLayout();			
				require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';		
				$md = new Models_Quest_Detail();									
				$this->view->arrQuest = $md->filterQuest($_POST);				
			}
			
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function listtaskAction(){
		try
		{
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Action.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Target.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Task_Client.php';
									
			$this->_helper->layout->disableLayout();			
			$questid = $this->_request->getParam("id");
			$md = new Models_Quest_Detail();
			$mdAction = new Models_Action();				
			$mdQuestTC = new Models_Quest_Task_Client();
			$mdTT = new Models_Task_Target();
			$mdQuestTC = new Models_Quest_Task_Client();
	
			//Hiện List q_action
			$this->view->arrTask = $md->getTask($questid);			
			$this->view->arrAction = $mdAction->_getAction();
			
			$this->view->arrTaskTarget = $mdTT->select($questid);
				
			//Hiện ListQuesstTaskClient 
			$this->view->arrQuestTC=$mdQuestTC->_getQuestTaskClient();
		
		}catch(Exception $ex){
			
	           Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	    }		
	}
			
	public function saveAction(){
		/////////////Udate Award ID///////////////
		try{
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
				
				
				$arrItem = $_POST["awarditem"];
				$arrAddItem = $_POST["additem"];				
				///Update
				updateAwardItem($arrItem, $arrAddItem,$form->obj->QuestID);
				Models_Log::insert($this->view->user->username, "act_update_award_item");
				
				//////////////////////////////////////////
				///////////////////Update need quest////////////////////////
				
			//	$arrNeedQuest = $_POST['need-quest'];
			//	$arrAddNeedQuest = $_POST['need-quest-add'];			
			//	updateNeedQuest($arrNeedQuest, $arrAddNeedQuest,$form->obj->QuestID);
				 
				echo "1";
			}
				
		}catch(Exception $ex) {
	           $this->view->errMsg = $ex->getMessage();
	           echo $this->view->errMsg;
			   Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	    }	
	} 
	
	public function addAction()
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
			//Lay maxid
			$md_getmax= new Models_Quest();
			$idmax =$md_getmax->getMaxQuestID();
			$id=$idmax+1;
			//			
			$md = new Models_Quest_Detail();
			$this->view->arrValue = $md->_getQuestLine();
			$this->view->arrQuest = $md->getQuest();
			$this->view->arrNeedQuest = $md->getNeedQuest($id);
			$this->view->arrnextQuest = $md->getQuest();
			$this->view->QuestID = $id;
			
			$form = new Forms_Quest_Detail();
			$form->_requestToForm($this);	
			$form->validate(INSERT);
				
			if($this->_request->isPost()){
				//$form = new Forms_Quest_Detail();
				//$form->_requestToForm($this);	
				//$form->validate(INSERT);			
				$md = new Models_Quest_Detail();

				$md->_insert($form->obj);
				$this->QuestID= $form->obj->QuestID;	

				
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
           $this->view->errMsg = $ex->getMessage();
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
				Models_Log::insert($this->view->user->username, "act_update_need_quest");			
			}
			echo "Cập nhật thành công";
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}		
	}
	
	public function updatenextquestAction()
	{
		try{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest.php';
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			if($this->_request->isPost())
			{
				$this->QuestID=$this->_request->getParam('questid');
				$this->NextQuest=$this->_request->getParam('nextquest');
				print_r($this->NextQuest);
				
				if(empty($this->NextQuest))
				{
					$this->NextQuest = NULL;
				}
				$form=new Models_Quest();
				$form->updateNextquest($this->QuestID,$this->NextQuest);
				Models_Log::insert($this->view->user->username, "act_update_next_quest");
				
			}
			echo "Cập nhật thành công";
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
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
	///////////////////////////////////////////
	function updateAwardItem($arrItem,$arrAddItem,$questID){
		$item_md = new Models_Quest_Awarditem();
		if(!empty($arrItem)){
				foreach ($arrItem as $key => $value) {/// $key la ID cua Bang q_quest_awarditem					
					if($value == ""){                /// $value la gia tri awarditem						
						$item_md->_delete($key);
					}else{
						$item_obj = new Obj_Quest_Awarditem();
						$item_obj->ID = $key;
						$item_obj->QuestID = $questID;
						$item_obj->AwardItem = $value;						
						$item_md->_update($item_obj);
					}
				}	
			}
			//Add
			if(!empty($arrAddItem)){
				foreach ($arrAddItem as $value) {/// $key la ID cua Bang q_quest_awarditem
					if($value != ""){                    /// $value la gia tri awarditem				
						$item_obj = new Obj_Quest_Awarditem();
						$item_obj->QuestID = $questID;
						$item_obj->AwardItem = $value;								
						$item_md->_insert($item_obj);
					}
				}	
			}	
	}
	
	
	

?>


