<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Gift_Package.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Package.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Package_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Gift_Package_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_xfj.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_QTC.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Package.php';
//require_once ROOT_APPLICATION_MODELS.DS.'Models_Action_Package.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Task_Target_Package_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Event.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item_Increment.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';

require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'PigManager.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'ItemManager.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_GiftPackage_Detail.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Item.php';

class ExportController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','active','item','additem','pigshop','itemshop');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function exportAction()
	{
		$model = new Models_Quest_Package();
		$tuo = new Models_Quest_Package();
		$data = $tuo->getGiftType();
		$model->generate($data);
////////////////////////////////////////////////		
		
		
		$model1 = new Models_Task_Package();
		$tuo1 = new Models_Task_Package();
		$data1 = $tuo1->getGiftType();
		$model1->generate($data1);
/////////////////////////////////////////////		
		
		$model2 = new Models_Quest_xfj();
		$tuo2 = new Models_Quest_xfj();
		$data2 = $tuo2->getGiftType();
		$model2->generate($data2);
		
		$this->_redirect ("/export/download");
		//	echo GIFT_PACKAGE_PHP_FILE;
		// $f=ROOT.'/config/Gift.php'; //Khai bÃ¡o Ä‘Æ°á»�ng dáº«n cá»§a file cáº§n ghi dá»¯ liá»‡u @ 
		// $ft=fopen($f,"w"); //Má»Ÿ file cáº§n ghi 
		// $f="Ä�Ã¢y lÃ  pháº§n hÆ°á»›ng dáº«n PHP"; //Khai bÃ¡o ná»™i dung cá»§a file 
		// fwrite($ft,$f); //Thá»±c hiá»‡n ghi ná»™i dung vÃ o file 
		// if(fwrite){ //Náº¿u ghi Ä‘Æ°á»£c thÃ¬... 
		// echo "ThÃ nh cÃ´ng"; 
		// }	
		// else{ echo "CÃ³ lá»—i phÃ¡t sinh"; } 
		//$this->_redirect ("gift/index");
	}

	public function indexAction()
	{
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Gift_Package.php';
			
			$this->_getArrEvent();
			
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			$form = new Forms_Gift_Package();
			$form->_requestToForm($this);
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$md= new Models_Gift_Package();
			$data = $md->filter($form->obj, "id DESC", ($pageNo - 1)*$items, $items);
			$count = $md->count($form->obj);			
			
			$this->view->data = $data;
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;
			
			if($this->_request->getParam("hidSync"))
			{
				$location = $this->_request->getParam("hidLocation");
				
				$data = $md->_filter(null, "id DESC", 0, 0);
				
				$mdSaleOffShop = new Models_SaleOff_Shop();
				$saleOffData = $mdSaleOffShop->_filter();
				$mdItem = new Models_Item();
				$items = $mdItem->_filter();
				
				$md->sync($data,$items,$saleOffData,$location);
				$this->view->msg = "Sync dá»¯ liá»‡u thÃ nh cÃ´ng";
			}
			
			$this->view->form = $form->obj;
		}
		catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	

}
?>
