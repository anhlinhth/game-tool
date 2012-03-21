<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'models'.DS.'Models_Campaign.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'models'.DS.'Models_WorldMap.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

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

	///////////////////////////////////////
	/////////////////Thaonx//////////////
	public function updateawardAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Award.php';
			if($this->_request->isPost())
			{
				$action = $_POST['Action'];
				switch ($action) {
					case 'insert':
						$battleID = $_POST['BattleID'];
						$mdAward = new Models_Award();
						$mdAward->insertAward($battleID);
						echo "1";					
						break;
					case 'delete':
						$ID = $_POST['ID'];
						$mdAward = new Models_Award();
						$mdAward->deleteAward($ID);
						echo "1";
						break;
					case 'update-type':
							$ID = $_POST['ID'];
							$Type = $_POST['Type'];						
							$mdAward = new Models_Award();
							$mdAward->updateAwardType($ID,$Type,$Value);
							echo "1";
							break;
					case 'update-all':
							$battleID = $_POST['BattleID'];
							$arrType = $_POST['AwardTypeID'];
							$arrValue = $_POST['Value'];							
							$mdAward = new Models_Award();
							$mdAward->updateAward($battleID,$arrType,$arrValue);
							echo "1";
							break;
					default:
						;
					break;
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
	
	////////////////////////////////////////////Edit///////////////////////////////////////////
	public function editAction()
	{
		try 
		{
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Award.php';
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Layout.php';
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Battle.php';
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Award_type.php';
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Battle_Soldier.php';		
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Soldier.php';
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Worldmap.php';	
			
			$id = $this->_request->getParam("id");
			
			///////Lấy Campaign//////////
			$mdCamp = new Models_Campaign();			
			$this->view->campaign = $mdCamp->_getByKey($id);
			//var_dump($campaign);			
			
			///////Lấy danh sách Battle ///////////
			//$mdbattle = new Models_Battle();			
			
			///////Lấy danh sách Layout//////////
			$mdlayout = new Models_Layout();
			$this->view->arrlayout =  $mdlayout->getLayout();			
			//print_r($this->view->arrlayout);
			///////Lấy danh sách Award//////////
			$mdawardtype = new Models_Award_Type();
			$this->view->arrawardtype = $mdawardtype->getAwardtype();
			////
		
			///////Đối với mỗi battle//////
			$mdB_layout = new Models_Soldier();
			$this->view->arrSoldier=$mdB_layout->getAllSoldier();					
			$mdB=new Models_Battle();			
			$this->view->arrbattle=$mdB->getBattle($id);
			
			$mdBS=new Models_Battle_Soldier();
			$this->view->arrBattleSolider=array();
			$arrPoint = array();
			foreach ($this->view->arrbattle as $row)
			{	
				
				$strPoint =  $row->Point;
				$strPoint = substr($strPoint,1,strlen($strPoint)-2);
				$arr = explode(',',$strPoint )	;		
				$arrPoint[$row->ID] = $arr;
				$this->view->arrBattleSolider[$row->ID]=$mdBS->getbattle_soldier($row->ID);
			}
			$this->view->arrPoint = $arrPoint;
			$arrbattle = $this->view->arrbattle;
			$this->view->layout[] = array();
			
			///////Lấy Award - ThaoNX////////////
						
			$md_award = new Models_Award();
			$this->view->arrAwardType = $md_award->getAwardType();
			$this->view->arraward = array();
			
			foreach ($this->view->arrbattle as $row)
			{
				$idbattle= $row->ID;			
			
				$this->view->arraward[$idbattle] = $md_award->getAward($idbattle);
				
			}
			
			
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function loadlayoutAction()
	{
		try{
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Layout.php';
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			$mdlayout = new Models_Layout();
			$id=$_POST['id'];
			$layout=array();
			$layout =  $mdlayout->getLayoutById($id);
			//echo json_encode($layout);
			$strPoint =	$layout[0]->Point;
					
			$strPoint = substr($strPoint,1,strlen($strPoint)-2);
			$arrPoint = explode(',',$strPoint);
			$arr = array();
			foreach ($arrPoint as $key =>$value) {
				$arr["point".$key] = $value;
			}
			
			
			
			echo json_encode($arr);
			
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		
		}
	}
}
