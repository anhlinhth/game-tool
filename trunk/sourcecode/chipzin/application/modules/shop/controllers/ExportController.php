<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';

require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS.'Models_S_Export_Logic.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS.'Models_S_Export_SetString.php';

class Shop_ExportController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','update','delete');
	}
	public function preDispatch()
	{
		parent::preDispatch();
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function indexAction()
	{
		if ($this->_request->isPost ()) 
		{
			
			$mdString= new Models_S_Export_SetString();
			$mdLogic= new Models_S_Export_Logic();
			
			
			//---String---------------------------------------
			$shopClient=$mdString->shop_version_xfj();
			$building=$mdString->ShopBuilding_conf_php();
			$hero=$mdString->ShopHero_conf_php();
			$item=$mdString->ShopItem_conf_php();
			$quantity=$mdString->ShopItemQuantity_conf_php();
			$soldier=$mdString->ShopSoldier_conf_php();
			$version=$mdString->Version_conf_php();
			//------------------------------------------------
			
			
			//---To file--------------------------------------
			$name=$mdLogic->getName_shopClient();
			
			$kq1=$mdLogic->shop_version_xfj($shopClient, $name);
			$kq2=$mdLogic->ShopBuilding_conf_php($building);
			$kq3=$mdLogic->ShopHero_conf_php($hero);
			$kq4=$mdLogic->ShopItem_conf_php($item);
			$kq5=$mdLogic->ShopItemQuantity_conf_php($quantity);
			$kq6=$mdLogic->ShopSoldier_conf_php($soldier);
			$kq7=$mdLogic->Version_conf_php($version);
			//------------------------------------------------
		 
			if($kq1==1 && $kq2==1 && $kq3==1 && $kq4==1 && $kq5==1 && $kq6==1 && $kq7==1)
			{
			$this->view->msg="Thành công !";
			$mdLogic->updateVer();
			}
			else $this->view->errMsg="Thất bại ! Hãy thử lại !";
			
		}
	}
	
}
