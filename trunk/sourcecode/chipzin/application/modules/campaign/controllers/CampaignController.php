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
			////////
			$mdB_award = new Models_Award();
			$this->view->arraward = array();
			
			foreach ($this->view->arrbattle as $row)
			{
				$idbattle= $row->ID;			
			///////Lấy Award////////////
				$this->view->arraward[$idbattle] = $mdB_award->getAward($idbattle);
				
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
	
}
	
	

?>


