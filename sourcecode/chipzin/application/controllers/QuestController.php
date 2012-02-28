<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Needquest.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Awarditem.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Detail.php';

require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';	

class QuestController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','active','item','additem','pigshop','itemshop','update');
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
			$count = $md->count($form->obj);
			
			$this->view->data = $data;
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
				$this->view->arrNeedQuest = $md->getNeedQuest($id);
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
			$this->view->arrNeedQuest = $md->getNeedQuest($id);
			$this->view->arrAwardItems = $md->getAwardItems($id);
			$this->view->arrTask = $md->getTask($id);
			$this->view->arrQuest = $md->getQuest($id);	
			if($this->_request->isPost())
			{
				//update quest
		//		print_r($_POST);
		//		exit();
				//print_r($_POST);
				$this->_helper->layout()->disableLayout();
				$this->_helper->viewRenderer->setNoRender();	
				$form = new Forms_Quest_Detail();
				$form->_requestToForm($this);					
				$form->validate(UPDATE);
				$form->obj->QuestID;			
				$md = new Models_Quest_Detail();			
				$md->_insert($form->obj);
				$this->QuestID= $form->obj->QuestID;	

				//update quest need quest
				$this->arrNeedQuest = $this->_request->getParam("need-quest-add");
				$mdNeedQuest = new Models_Quest_Needquest();
				$mdNeedQuest->_delete($this->QuestID);
				foreach($this->arrNeedQuest as $i=>$key)
				{
					
					$objneedquest = new Obj_Quest_Needquest();
					$objneedquest->ID = "NULL";
					$objneedquest->QuestID = $this->QuestID;
					$objneedquest->NeedQuest = $this->arrNeedQuest[$i];
					if($objneedquest->NeedQuest != "")
					{
						$mdNeedQuest->_insert($objneedquest);
					}
				}
				Models_Log::insert($this->view->user->username, "act_update_needquest");
				
				//update quest awarditem
				$this->AwardItem = $this->_request->getParam("additem");
				$mdAwardItem = new Models_Quest_Awarditem();
				$mdAwardItem->_delete($this->QuestID);
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
				Models_Log::insert($this->view->user->username, "act_update_AwardItem");
				//$this->view->msg = "them thanh cong";
				print_r("thanh cong");
			}	
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
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
			$id = $this->_request->getParam("id"); //luu y cho nay nen dat id trung csd		

//			require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
//			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Needquest.php';
//			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Awarditem.php';
//			$mdtask = new Models_Task();
//			$mdtask->_delete($id);
//			
//			$mdquestneedquest= new Models_Quest_Needquest();
//			$mdquestneedquest->_delete($id);
//			
//			$mdquestawarditem = new Models_Quest_Awarditem();
//			$mdquestawarditem->_delete($id);
			
			$mdquest = new Models_Quest();
			$mdquest->delete($id);
						
			Models_Log::insert($this->view->user->username, "act_delete_quest");
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
		if($this->_request->isPost())// da post du lieu len
		{	
					
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
			//////////////////////////////////////////
			///////////////////Update need quest////////////////////////
			
			$arrNeedQuest = $_POST['need-quest'];
			$arrAddNeedQuest = $_POST['need-quest-add'];			
			updateNeedQuest($arrNeedQuest, $arrAddNeedQuest,$form->obj->QuestID);
			
			$arrTaskID = $_POST["TaskID"];
			$arrTarget = $_POST["Target"];
			$arrTargetType = $_POST["TargetType"];
			print_r($arrTargetType);	
			$this->_redirect('/quest/edit/id/'.$form->obj->QuestID);
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
	
	function updateNeedQuest($arrNeedQuest,$arrAddNeedQuest, $questID){
		$nq_md = new Models_Quest_Needquest();
			///Update
			if(!empty($arrNeedQuest)){
				foreach ($arrNeedQuest as $key => $value) {/// $key la ID cua Bang q_quest_awarditem					
					if($value == ""){              /// $value la gia tri awarditem								
						$nq_md->_delete($key);
					}else{
						$nq_obj = new Obj_Quest_Needquest();
						$nq_obj->ID = $key;
						$nq_obj->QuestID = $questID;
						$nq_obj->NeedQuest = $value;
						
						$nq_md->_update($nq_obj);
					}
				}	
			}
			//Add
			if(!empty($arrAddNeedQuest)){
				foreach ($arrAddNeedQuest as $value) {/// $key la ID cua Bang q_quest_awarditem
					if($value != ""){                    /// $value la gia tri awarditem				
						$nq_obj = new Obj_Quest_Needquest();
						$nq_obj->QuestID = $questID;
						$nq_obj->NeedQuest = $value;								
						$nq_md->_insert($nq_obj);
					}
				}	
			}	
	}

?>


