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
				$arrLevel = $_POST['levelSolider'];
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
				//save award
				$mda = new Models_Award();
				$arrAwardID = $_POST['AwardTypeID'];
				$arrValue = $_POST['Value'];
				///////Xoa trung////////
				$idAward = array();
				$i = count($arrAwardID)-1;
				while($i>=0)
				{
					$flag = false;
					foreach($idAward as $item)
					{
						if($item == $arrAwardID[$i])
						{
							unset($arrAwardID[$i]);
							unset($arrValue[$i]);
							$flag = true;
							break;
						}
					}
					if($flag == false)
					{
						$idAward[] = $arrAwardID[$i];
					}
					$i--;
				}
				//////end xoa trung////
				$mda->delAward($objBattle->ID);
				if(!empty($arrAwardID)){
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
	///////////////////ThaoNX/////////////////////////
	public function deleteAction(){
	    try
	    {
	    	$this->_helper->layout->disableLayout();
	    	$this->_helper->viewRenderer->setNorender();
	    	if($this->_request->isPost())
	    	{
	    		$battleID = $_POST['BattleID'];	    		   		
	    		$mdbattle = new Models_Battle();
	    		$mdbattle->delete($battleID);
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
	public function addAction()
	{
		try {
			$mdbattle = new Models_Battle();
			$objBattle = new Obj_Battle();
			$objBattle->ID = "NULL";
			$objBattle->Campaign = $_POST['campaignID'];
			$objBattle->Layout = 1;
			$objBattle->Order = 1;
			$mdbattle->_insert($objBattle);
			echo "Th�nh c�ng";
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	public function getinfoAction()
	{
		try
	    {
	    	$this->_helper->layout->disableLayout();
	    	$this->_helper->viewRenderer->setNorender();
	    	if($this->_request->isPost())
	    	{
	    		$battleID = $_POST['BattleID'];	    		   		
	    		$mdbattle = new Models_Battle();
	    		$obj_battle = $mdbattle->getBattleInfo($battleID);
	    		echo json_encode((array)$obj_battle);	    		
	    	}
	    }
	    catch(Exception $ex)
	    {
	    	$this->view->errMsg = $ex->getMessage();
	    	echo $this->view->errMsg;
	    	Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	    }
	}
	
	function deleteTrung($arrID, $arrValue)
	{	
		$id = array();
		$i = count($arrID);
		$j=0;
		while($i>=0)
		{
			$flag = false;
			foreach($id as $item)
			{
				if($item == $arrID)
				{
					unset($arrID[$i]);
					unset($arrValue[$i]);
					$flag = true;
					break;
				}
			}
			if(flag == false)
			{
				$id[count($id)+1] = $arrID[$i];
			}
			$i++;
		}
		$return[id] = $arrID;
		$return[value] = $arrValue;
		return $return;
	}
}


