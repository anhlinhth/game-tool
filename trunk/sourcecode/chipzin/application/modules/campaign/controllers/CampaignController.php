<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Campaign.php';
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
		$md = new Models_Campaign();
		echo $md->getAllbattle();
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
			$mdB_layout = new Models_Battle_Soldier();
			$this->view->arrSoldier=$mdB_layout->getAllSoldier();
			$mdB=new Models_Battle();
			$this->view->arrbattle=$mdB->getBattle();
			
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
			//print_r($this->view->award);
//			$this->view->battle_Layout[] = $layout[];
//			$this->view->battle_award[] = $award[];
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
}
