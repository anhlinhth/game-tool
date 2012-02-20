<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Gift_Package.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Gift_Package_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Event.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item_Increment.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';

require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'PigManager.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'ItemManager.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_GiftPackage_Detail.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Item.php';

class GiftController extends BaseController
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
				$this->view->msg = "Sync dữ liệu thành công";
			}
			
			$this->view->form = $form->obj;
		}
		catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function addAction()
	{
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Gift_Package.php';
			
			$this->_getArrEvent();
			
			if($this->_request->isPost())
			{
				$form = new Forms_Gift_Package();
				$form->_requestToForm($this);
				
				$objItem = new Obj_Item();				
				$checkNew = $this->_request->getParam("chkNewItem");
				
				$objItem->priceInGame	= $this->_request->getParam("priceInGame");
				$objItem->priceOutGame	= $this->_request->getParam("priceOutGame");
				$objItem->disCount		= $this->_request->getParam("disCount");
				
				$form->validate(INSERT);				
				if($checkNew)
				{					
					$objItem->image			= $_FILES['image']['name'];					
					$objItem->type			= ITEM_TYPE_GIFT;
					$objItem->description	= $form->obj->description;
					$objItem->haveDefault	= 0;
					$objItem->name			= $form->obj->name;
					$objItem->quantity		= 1;
					$objItem->key			= 'ITEM_GIFT_PACKAGE';
					$objItem->effect		= $form->obj->alias;
					$objItem->level			= 0;
					$objItem->limited		= -1;
					$objItem->useAtHome		= 0;
					$objItem->maxLevel		= -1;
					$objItem->exp			= 0;
					$objItem->refineLevel	= 0;
					$objItem->expiredCoin	= 0;						
					$objItem->status		= 0;
					$objItem->currentStatus	= 0;
					$objItem->order			= 100;					
					
					if($form->obj->type == GIFT_TYPE_SELLOFF)
						$objItem->enableInShop	= true;
					else
						$objItem->enableInShop	= false;
					
					$mdIncrement = new Models_Item_Increment();
					$itemId = $mdIncrement->getId();			
					$newId = $itemId + 1;

					$objItem->id = $newId;
					
					$file = $_FILES['image'];
					if(!$file)
						throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_NULL,"Vui lòng chọn hình");
					
					$checkFile = Utility::validateFile($file);
					if(!$checkFile)
						throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_NULL,"Không đúng định dạng hình ảnh");
					
					move_uploaded_file( $file['tmp_name'] , ROOT_MEDIA_IMAGE_ITEM_ITEMGIFT.DS . $_FILES['image']['name'] ) ;				
				}
				
				$md = new Models_Gift_Package();
				$md->insert($form->obj);	
				$mdIncrement->update($newId);
				
				if($checkNew)
				{
					//Add new item
					$mdItem = new Models_Item();
					$mdItem->_insert($objItem);
					
					//Add item in saleOff Shop
					if($form->obj->type == GIFT_TYPE_SELLOFF)
					{
						$mdSaleOffShop = new Models_SaleOff_Shop();
						$objSaleOff->item_id = $newId;
						$mdSaleOffShop->_insert($objSaleOff);
					}					
				}
				
				Models_Log::insert($this->view->user->username, "act_add_gift", $form->obj->name);
				$this->_redirect("/gift/index");
			}
		}
		catch(Exception $ex)
        {
			$this->view->objItem = $objItem;
			$this->view->chkNew = $checkNew;
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function editAction()
	{
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Gift_Package.php';
			
			$this->_getArrEvent();
			
			$md = new Models_Gift_Package();
			
			if($this->_request->isPost())
			{
				$form = new Forms_Gift_Package();
				$form->_requestToForm($this);
				$form->validate(UPDATE);
				
				$md->update($form->obj);
				
				$mdItem = new Models_Item();
				$objSearch->effect = $form->obj->alias;
				$items = $mdItem->filter($objSearch, null, null, null);				
				
				$item = $items[0];
				$item->description 	= $form->obj->description;
				$item->name			= $form->obj->name;
				
				$mdItem->_update($obj);
				
				Models_Log::insert($this->view->user->username, "act_edit_gift", $form->obj->name);
				$this->_redirect("/gift/index");
			}
			else
			{
				$id = $this->_request->getParam("id");
				$obj = $md->_getByKey($id);		
				
				if($obj->start_date)
				{
					$obj->start_date = date_format(date_create($obj->start_date), "m/d/Y");
				}
				
				if($obj->end_date)
				{
					$obj->end_date = date_format(date_create($obj->end_date), "m/d/Y");
				}
				
				$this->view->form = $obj;
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
			$this->_helper->viewRenderer->setNorender();
			
			if($this->_request->isPost())
			{				
				$id = $this->_request->getParam("id");				
				$md = new Models_Gift_Package();
				$mdGiftPackage_Detail = new Models_Gift_Package_Detail();
				$mdGiftPackage_Detail->_delete($id, "gift_package_id");
				
				$obj = $md->_getByKey($id);
				$md->_delete($id);
				
				Models_Log::insert($this->view->user->username, "act_delete_gift", $obj->name);
			}
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function itemAction()
	{
		try
		{
			$md = new Models_Gift_Package();
			$id = $this->_request->getParam("id");
			$obj = $md->_getByKey($id);				
			$this->view->obj = $obj;
			
			$mdGiftPackageDetail = new Models_Gift_Package_Detail();
			$objSearch->gift_package_id = $id;
			$data = $mdGiftPackageDetail->_filter($objSearch);
			$this->view->data = $data;
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function additemAction()
	{
		try
		{
			$this->_helper->layout->setLayout('popup');
			$md = new Models_Gift_Package();
			$giftType = $md->getGiftType();
			
			$this->view->giftType = $giftType;
			
			if($this->_request->isPost())
			{
				$this->_helper->layout->disableLayout();
				$this->_helper->viewRenderer->setNoRender();
				$obj = new Obj_GiftPackage_Detail();
				
				$type = $this->_request->getParam("type");
				$hidType = $this->_request->getParam("hidType");
				if($hidType != "")
					$type = $hidType;
				
				$quantity = $this->_request->getParam("quantity");
				$rank = $this->_request->getParam("rank");
				$obj_id	= $this->_request->getParam("object_id");
				$gift_id = $this->_request->getParam("gift_id");
				
				$obj->gift_package_id = $gift_id;
				$obj->object_id = $obj_id;
				$obj->type = $type;
				$obj->quantity = $quantity;
				$obj->rank	= $rank;
				
				$mdGiftPackageDetail = new Models_Gift_Package_Detail();
				$mdGiftPackageDetail->_insert($obj);
				
				Models_Log::insert($this->view->user->username, "act_add_item_gift");
			}
			else
			{
				$id = $this->_request->getParam("id");
				$this->view->id = $id;
			}
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function pigshopAction()
	{
		try
		{
			$this->_helper->layout->setLayout('popup');
			
			$xmlDoc = Utility::openXML(XML_PATH);
			
			$this->view->RecordPerPage = 10;
            $this->view->CurPage = 1;
            if(isset($_GET['page']))
                $this->view->CurPage = $_GET['page'] + 0;

            $start = ($this->view->CurPage - 1) * $this->view->RecordPerPage;
            $end = $start + $this->view->RecordPerPage - 1;
            
            if(isset($_GET['searchAll']))
            {
                $this->view->dislayData = PigManager::GetInstance()->LoadDislayData($xmlDoc, $start, $end);
            }
            
            if(isset($_GET['search']))
            {
                $name = $_GET['name'];
                $gender = $_GET['gender'];
                $level = $_GET['level'];
                $TotalRecord = 0;
                $this->view->dislayData = PigManager::GetInstance()->Search($xmlDoc,$name,$gender,$level, $start, $end, $TotalRecord);
                $this->view->TotalRecord = $TotalRecord;
            }
            else
            {
                $this->view->TotalRecord = PigManager::GetInstance()->GetLenght($xmlDoc);
                $this->view->dislayData = PigManager::GetInstance()->LoadDislayData($xmlDoc, $start, $end);    
            }
            
            $this->view->TotalPage = ceil($this->view->TotalRecord / $this->view->RecordPerPage);
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function itemshopAction()
	{
		try
		{
			$this->_helper->layout->setLayout('popup');
			$xmlDoc = Utility::openXML(XML_PATH);
			
			$this->view->RecordPerPage = 7;
            $this->view->CurPage = 1;
            if(isset($_GET['page']))
                $this->view->CurPage = $_GET['page'] + 0;

            $start = ($this->view->CurPage - 1) * $this->view->RecordPerPage;
            $end = $start + $this->view->RecordPerPage - 1;
            
            if(isset($_GET['searchAll']))
            {
                $this->view->dislayData = ItemManager::GetInstance()->LoadDislayData($xmlDoc, $start, $end);
            }
            
            if(isset($_GET['search']))
            {
                $name = $_GET['searchName'];
                $type = $_GET['searchType'] - 1;
                $TotalRecord = 0;
                $this->view->dislayData = ItemManager::GetInstance()->Search($xmlDoc,$name, $type, $start, $end, $TotalRecord);
                $this->view->TotalRecord = $TotalRecord;
            }
            else
            {
                $this->view->TotalRecord = ItemManager::GetInstance()->GetLenght($xmlDoc);
                $this->view->dislayData = ItemManager::GetInstance()->LoadDislayData($xmlDoc, $start, $end);    
            }
            
            $this->view->TotalPage = ceil($this->view->TotalRecord / $this->view->RecordPerPage);
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function deleteitemAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$id = $this->_request->getParam("id");
			
			$mdGiftPackageDetail = new Models_Gift_Package_Detail();
			$mdGiftPackageDetail->_delete($id);	
			Models_Log::insert($this->view->user->username, "act_delete_item_gift");
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function activeAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$id = $this->_request->getParam("id");
			$status = $this->_request->getParam("status");
			
			$arrId = explode(",", $id);
			if($arrId > 0)
			{
				$md = new Models_Gift_Package();				
				foreach($arrId as $id)
				{
					$obj = $md->_getByKey($id);
					$md->setStatus($id, $status);
					if($status == 1)					
						$note = "Kích hoạt: ". $obj->name;					
					else
						$note = "Bỏ kích hoạt: ". $obj->name;
					
					Models_Log::insert($this->view->user->username, "act_change_status_item_gift",$note);
				}
			}
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function edititemAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();			
			
			$newValue = $this->_request->getParam("update_value");
			$oldValue = $this->_request->getParam("original_value");
			$elementId = $this->_request->getParam("element_id");
			
			if(!Zend_Validate::is($newValue,'Digits'))
			{
				echo "-1!"."$oldValue";
				return;
			}
			
			$arr = explode("_", $elementId);
			
			$id = $arr[1];
			
			$md = new Models_Gift_Package_Detail();
			$obj = $md->_getByKey($id);
			
			if($arr[0] == 'quantity')
				$obj->quantity = $newValue;
			if($arr[0] == 'rank')
				$obj->rank = $newValue;
			
			$md->_update($obj);
			
			echo "0!$newValue";
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	private function _getArrEvent()
	{
		$md = new Models_Event();
		$events = $md->_filter();
		
		$data = array();
		if($events)
		{
			foreach($events as $event)
			{
				$data[] = array(
					'id' => $event->id,
					'name' => $event->name
				);
			}
			
			$this->view->arrEvent = $data;
		}
	}
}
?>
