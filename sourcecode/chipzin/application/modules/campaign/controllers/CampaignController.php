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
		echo $md->get();
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
			
			$id = $this->_request->getParam("id");
			///////Lấy Campaign//////////
			$mdCamp = new Models_Campaign();
			$this->view->campaign = $mdCamp->getcampaig($id);
			///////Lấy danh sách Battle///////////
			$mdbattle = new Models_Battle();
			$this->view->arrbattle = $mdbattle->getBattle($id);
			
			///////Lấy danh sách Layout//////////
			$mdlayout = new Models_Layout();
			$this->view->arrlayout = $mdlayout->getLayout();
			
			///////Lấy danh sách Award//////////
			$mdaward = new Models_Award_Type();
			$this->view->arraward = $mdaward->getAwardtype();
			
			///////Đối với mỗi battle//////
			$mdB_layout = new Models_Battle_Soldier();
			$mdB_award = new Models_Award();
			$arrbattle = $this->view->arrbattle;
			$this->view->layout[] = array();
			$this->view->award[] = array();
			foreach ($arrbattle as $row)
			{
				$idBattel = $row->ID;
			///////Lấy Layout///////////
				$this->view->layout[$idBattel] = $mdB_layout->getbattle_soldier($idBattel);
			///////Lấy Award////////////
				$this->view->award[$idBattel] = $mdB_award->getAward($idBattel);
			}
		//	$this->view->battle_Layout[] = $layout[];
		//	$this->view->battle_award[] = $award[];
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}
	
}
	
	

?>


