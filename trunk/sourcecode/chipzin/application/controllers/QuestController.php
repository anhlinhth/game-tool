<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Detail.php';


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
			
			$form = new Forms_Quest();
			$form->_requestToForm($this);
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;

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
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';			
			
			$md = new Models_Quest_Detail();
			
			if($this->_request->isPost())// da post du lieu len
			{				
				$form = new Forms_Quest_Detail();
				$form->_requestToForm($this);
				$form->validate(UPDATE);		
				//$this->view->obj = $form->obj;		
				$md->update($form->obj);				
				Models_Log::insert($this->view->user->username, "act_edit_gift", $form->obj->name);
				$this->_redirect("/quest/index");
			}
			else{		// chua post du lieu-->load du lieu vao Form		
				$id = $this->_request->getParam("id");
				$this->view->obj = $md->_getByKey($id);
				$this->view->arrValue = $md->getQuestLine();
				$this->view->arrNeedQuest = $md->getNeedQuest($id);
				$this->view->arrAwardItems = $md->getAwardItems($id);
				$this->view->arrTask = $md->getTask($id);
				$this->view->arrQuest = $md->getQuest();
				$this->view->arrnextQuest = $md->getnextQuest($id);
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
			$mdquest = new Models_Quest();
			$mdquest->_delete($id);	
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
	
	public function listneedquestAction()
	{		
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';			
			
			$md = new Models_Quest_Detail();
			
			if($this->_request->isPost())// da post du lieu len
			{					
				$id = $this->_request->getParam("id");
				$this->view->obj = $md->_getByKey($id);				
				$this->view->arrNeedQuest = $md->getNeedQuest($id);					
				$this->view->arrQuest = $md->getQuest();
				
			}
			
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	

	public function listquestAction()
	{		
		try
		{	$this->_helper->layout()->disableLayout();
			$md = new Models_Quest_Detail();						
			$this->view->arrQuest = $md->getQuest();
		
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	

	public function updateAction()
	{
		try
		{			
			require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Task.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Task.php';
			require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Needquest.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Needquest.php';
			require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Awarditem.php';
			require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Awarditem.php';
		
			if($this->_request->isPost())// da post du lieu len
			{	
				$this->QuestID= $this->_request->getParam("QuestID");
				$form->validate(UPDATE);
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
					$mdtask->_update($task);
					Models_Log::insert($this->view->user->username, "act_update_quest");				
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
?>
