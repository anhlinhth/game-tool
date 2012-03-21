<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Battle.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Battle_Soldier.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Award.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Battle.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Battle_Soldier.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';

class Campaign_BattleController extends BaseController
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
	public function saveAction()
	{
		try 
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			if($this->_request->isPost())
			{
				$mdbattle = new Models_Battle();
				$objBattle = new Obj_Battle();
				$objBattle->ID = $_POST['BattleID'];
				$objBattle->Layout = $_POST['Layout'];
				$objBattle->Order = $_POST['Order'];
				$objBattle->Campaign = $_POST['campaignID'];
				$mdbattle->saveBattle($objBattle);
				//save Battle Soldier
				$mdbs = new Models_Battle_Soldier();
				$arrSolider = $_POST['solider'];
				$arrLevel = $_POST['level'];
				$mdbs->deleteB_Soldier($objBattle->ID);
				foreach ( $arrSolider as $key => $value ) 
				{
					$objbs = new Obj_Battle_Soldier();
					$objbs->BattleID = $objBattle->ID;
					$objbs->Level = $arrLevel[$key];
					$objbs->Point = $key;
					$objbs->Soldier = $arrSolider[$key];
					$objbs->ID = "NULL";
					if($objbs->Soldier != "" && $objbs->Level != "")
					{
						$mdbs->updateB_Soldier($objbs);
					}
				}
				$mda = new Models_Award();
				$mda->delAward($objBattle->ID);
				$arrAwardID = $_POST['AwardTypeID'];
				$arrValue = $_POST['Value'];
				foreach ($arrAwardID as $key => $value )
				{
					$obja = new Obj_Award();
					$obja->ID = "NULL";
					$obja->BattleID = $objBattle->ID;
					$obja->AwardTypeID = $arrAwardID[$key];
					$obja->Value = $arrValue[$key];
					if($obja->AwardTypeID != "" && $obja->Value != "")
					{
						$mda->InsAward($obja);
					}
				}
				echo "1";
			}
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
}


