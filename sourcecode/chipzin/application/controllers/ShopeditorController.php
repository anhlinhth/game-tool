<?php

/**
* @author dinhlhn
* @since 25/8/2011
* @category Controller
*/

require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'PigManager.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'ItemManager.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item_Increment.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';

class ShopeditorController extends BaseController
{    
	public function _setUserPrivileges()
	{
		return array('index','pig','pigdetail','item','itemdetail', 'exportPig', 
					'exportitem','getitemid','itemmanager','activeitem');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();	
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	
	public function indexAction()
	{
		if(Utility::checkPrivilege($this->view, 'shopeditor', 'pig'))
			$this->_redirect ("/shopeditor/pig");
		
		if(Utility::checkPrivilege($this->view, 'shopeditor', 'item'))
			$this->_redirect ("/shopeditor/item");
            
        if(Utility::checkPrivilege($this->view, 'shopeditor', 'exportpig'))
            $this->_redirect ("/shopeditor/exportpig");
            
        if(Utility::checkPrivilege($this->view, 'shopeditor', 'exportitem'))
            $this->_redirect ("/shopeditor/exportitem");
	}
	
    public function pigAction()
    {
        try
        {
            $xmlDoc = Utility::openXML(XML_PATH);

            if(isset($_POST['submit']))
            {
                $pig = new Pig();

                /*if(isset($_POST['upload']))
                {
                    $material = new Material();
                    if($_POST['specialPig'] == 1)
                    {
                        $material->url = "localdata/swf/pigspecial" . $_FILES['uploadmaterial']['name'];    
                    }
                    else
                    {
                        $material->url = "localdata/swf/pig" . $_FILES['uploadmaterial']['name'];
                    }
                    
                    MaterialManager::GetInstance()->AddMaterial($xmlDoc, $material);

                    $pig->idMat = $material->id;
                }                        */
                $pig->gender = $_POST['gender'];
                $pig->type = $_POST['filename'] . "_" . $pig->gender;
                $pig->description = $_POST['description'];
                $pig->statusInShop = $_POST['statusInShop'];
                $pig->quantity = 0;
                $pig->name = $_POST['name'];
                $pig->shortDesc = $_POST['shortDesc'];
                $pig->stealPunish = $_POST['stealPunish'];
                $pig->begetPrice = $_POST['begetPrice'];
                $pig->begetPriceMax = $_POST['begetPriceMax'];
                $pig->level = $_POST['level'];
                $pig->specialPig = $_POST['specialPig'];
                $pig->lifeCycle = $_POST['lifeCycle'];
                $pig->health = $_POST['health'];
                $pig->weightGainPerHour = $_POST['weightGainPerHour'];
                $pig->weightDownPerHour = $_POST['weightDownPerHour'];
                $pig->priceForOneKg = $_POST['priceForOneKg'];
                $pig->weight = $_POST['weight'];
                $pig->priceInGame = $_POST['priceInGame'];
                $pig->priceOutGame = $_POST['priceOutGame'];
                $pig->unit = $_POST['unit'];
                $pig->image = "Pig_" . $pig->type . ".png" ;            
                $pig->status = $_POST['currentStatus'];            
                $pig->age = $_POST['age'];
                $pig->giftGoldMinHome = $_POST['giftGoldMinHome'];
                $pig->giftGoldMaxHome = $_POST['giftGoldMaxHome'];
                $pig->giftHonourHome = $_POST['giftHonourHome'];
                $pig->giftGoldMinFriend = $_POST['giftGoldMinFriend'];
                $pig->giftGoldMaxFriend = $_POST['giftGoldMaxFriend'];
                $pig->sellExp = $_POST['sellExp'];
                $pig->holyLevel = $_POST['holyLevel'];
                $pig->star = $_POST['star'];
                $pig->miniGame = $_POST['miniGame'];
                $pig->desUser = $_POST['desUser'];
                $pig->lvGF = $_POST['lvGF'];
                $pig->disCount = $_POST['disCount'];
                $pig->new = $_POST['new'];
                $pig->enableInShop = $_POST['enableInShop'];


                if($_POST['submit'] == "Add")
                {
                    PigManager::GetInstance()->AddPig($xmlDoc,$pig);
                    $xmlDoc->save(XML_PATH);
					Models_Log::insert($this->view->user->username, "act_add_pig");
                }
                else
                {
                    PigManager::GetInstance()->UpdatePig($xmlDoc, $_POST['id'], $pig);
                    $xmlDoc->save(XML_PATH);
					Models_Log::insert($this->view->user->username, "act_edit_pig");
                }
            }

            if(isset($_POST['delete']))
            {
                $checkbox = $_POST['checkbox'];
                for ($i = 0; $i < count($checkbox); $i++)
                {
                    PigManager::GetInstance()->DeletePig($xmlDoc, $checkbox[$i]);
                }
                $xmlDoc->save(XML_PATH);		
				Models_Log::insert($this->view->user->username, "act_delete_pig");
            }
            
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
            
            if( isset($_GET['sync']) )
            {
                Utility::syncDataConfig();
                $this->view->msg = "Sync dữ liệu thành công"; 
            }
            if( isset($_GET['exportPig']) )
            {
                PigManager::GetInstance()->ExportToPHP($xmlDoc);   
                $this->view->msg = "export dữ liệu thành công"; 
            }
            
            $this->view->TotalPage = ceil($this->view->TotalRecord / $this->view->RecordPerPage);
        }
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    
    public function pigdetailAction()
    {
        try
        {
            $xmlDoc = Utility::openXML(XML_PATH);
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $this->view->pig = PigManager::GetInstance()->LoadPigByID($xmlDoc, $id);
                $this->view->button = "Update";
            }
            else
            {
                $this->view->pig = new Pig();
                $this->view->button = "Add";
            }

            //$this->view->materials = MaterialManager::GetInstance()->LoadDislayData($xmlDoc);
            //$this->view->type = MaterialManager::GetInstance()->GetType($xmlDoc);   
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
            $xmlDoc = Utility::openXML(XML_PATH);

            if(isset($_POST['submit']))
            {
                $item = new Item();

                //$item->image = $_FILES['image']['name'];
                $item->type = $_POST['type'];
                $item->description = $_POST['description'];
                $item->haveDefault = $_POST['haveDefault'];
                if($item->haveDefault == 1)
                {
                    $item->haveDefault == "true";
                }
                else
                {
                    $item->haveDefault == "false";
                }
                $item->name = $_POST['name'];            
                $item->priceInGame = $_POST['priceInGame'];
                $item->priceOutGame = $_POST['priceOutGame'];
                $item->quantity = $_POST['quantity'];
                $item->status = $_POST['selectedStatus'];            
                $item->currentStatus = $_POST['currentStatus'];
                $item->key = $_POST['key'];            
                $item->limited = $_POST['limited'] * 24;
                $item->level = $_POST['level'];
                $item->limited = $_POST['limited'];
                $item->useAtHome = $_POST['useAtHome'];
                $item->maxLevel = $_POST['maxLevel'];
                $item->exp = $_POST['exp'];
                $item->rank = $_POST['rank'];
                $item->disCount = $_POST['disCount'];
                $item->new = $_POST['new'];
                $item->enableInShop = $_POST['enableInShop'];
				$item->giftType = $_POST['giftType'];
				$item->giftPackage = $_POST['giftPackage'];

                if($_POST['submit'] == "Add")
                {
                    ItemManager::GetInstance()->AddItem($xmlDoc,$item);
                    $xmlDoc->save(XML_PATH);
					Models_Log::insert($this->view->user->username, "act_add_item");
                }
                else
                {
                    ItemManager::GetInstance()->UpdateItem($xmlDoc, $_POST['id'], $item);
                    $xmlDoc->save(XML_PATH);
					Models_Log::insert($this->view->user->username, "act_edit_item");
                }
            }

            if(isset($_POST['delete']))
            {
                $checkbox = $_POST['checkbox'];
                for ($i = 0; $i < count($checkbox); $i++)
                {
                    ItemManager::GetInstance()->DeleteItem($xmlDoc, $checkbox[$i]);
                }
                $xmlDoc->save(XML_PATH);
				
				Models_Log::insert($this->view->user->username, "act_delete_item");
            }
            
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
                $type = $_GET['searchType'] ;
                $TotalRecord = 0;
                $this->view->dislayData = ItemManager::GetInstance()->Search($xmlDoc,$name, $type, $start, $end, $TotalRecord);
                $this->view->TotalRecord = $TotalRecord;
            }
            else
            {
                $this->view->TotalRecord = ItemManager::GetInstance()->GetLenght($xmlDoc);
                $this->view->dislayData = ItemManager::GetInstance()->LoadDislayData($xmlDoc, $start, $end);    
            }
            
            if( isset($_GET['sync']) )
            {
                Utility::syncDataConfig();
                $this->view->msg = "Sync dữ liệu thành công"; 
            }
            if( isset($_GET['exportItem']) )
            {
                ItemManager::GetInstance()->ExportToPHP($xmlDoc);   
                $this->view->msg = "export dữ liệu thành công"; 
            }
            
            $this->view->TotalPage = ceil($this->view->TotalRecord / $this->view->RecordPerPage);    
        }
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
	
	public function itemmanagerAction()
	{
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Item.php';
			
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$form->obj->hidAdvanceSearch = $this->_request->getParam("hidAdvanceSearch");
			
			$form = new Forms_Item();
			$form->_requestToForm($this);
			$form->obj->priceInGameFrom = $this->_request->getParam("priceInGameFrom");
			$form->obj->priceInGameTo = $this->_request->getParam("priceInGameTo");			
			$form->obj->priceOutGameFrom = $this->_request->getParam("priceOutGameFrom");
			$form->obj->priceOutGameTo = $this->_request->getParam("priceOutGameTo");
			
			$md = new Models_Item();
			$data = $md->filter($form->obj, "", ($pageNo - 1)*$items, $items);
			$count = $md->count($form->obj);
			
			$this->view->data = $data;
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;			
			$this->view->form = $form->obj;
			
			if($this->_request->getParam("hidSync"))
			{				
				$location = $this->_request->getParam("hidLocation");
				
				$data = $md->_filter();				
				$mdSaleOffShop = new Models_SaleOff_Shop();
				$saleOffData = $mdSaleOffShop->_filter();
				
				$md->sync($data,$saleOffData,$location);
				$this->view->msg = "Sync dữ liệu thành công";
			}
		}
		catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function activeitemAction()
	{
		try
		{	
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$id = $this->_request->getParam("id");
			$status = $this->_request->getParam("status");
			
			$arrId = explode(",", $id);
			$mdSaleOff = new Models_SaleOff_Shop();
			if($arrId > 0)
			{
				$md = new Models_Item();				
				foreach($arrId as $id)
				{
					$obj = $md->_getByKey($id);
					$md->setStatus($id, $status);
					if($status == 0)
					{
						$note = "Bỏ đặt trong shop: ". $obj->name;
						$mdSaleOff->_delete($id);
					}
					else
					{
						$note = "Đặt trong shop: ". $obj->name;
					}
					
					Models_Log::insert($this->view->user->username, "act_change_status_item",$note);
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
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Item.php';
			$id = $this->_request->getParam("id");
			$md = new Models_Item();
			$obj = $md->_getByKey($id);
			
			if($this->_request->isPost())
			{
				$form = new Forms_Item();
				$form->_requestToForm($this);
				
				$file = $_FILES['image'];				
				if($file['name'] != "")
				{
					$checkFile = Utility::validateFile($file);
					if(!$checkFile)
						throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_NULL,"Không đúng định dạng hình ảnh");

					move_uploaded_file( $file['tmp_name'] , ROOT_MEDIA_IMAGE_ITEM_ITEMGIFT.DS . $_FILES['image']['name'] ) ;
					
					$oldImage = $obj->image;
					$obj->image	= $file['name'];
				}
				
				$obj->disCount = $form->obj->disCount;
				$obj->enableInShop = $form->obj->enableInShop;
				$obj->priceInGame = $form->obj->priceInGame;
				$obj->priceOutGame = $form->obj->priceOutGame;
				
				$md->_update($obj);
				if($oldImage)
					unlink (ROOT_MEDIA_IMAGE_ITEM_ITEMGIFT.DS.$oldImage);
				
				if(!$obj->enableInShop && $obj->type == ITEM_TYPE_GIFT)
				{
					$mdSaleOffShop = new Models_SaleOff_Shop();
					$mdSaleOffShop->_delete($obj->id);
				}
				
				Models_Log::insert($this->view->user->username, "act_edit_item", $obj->name);
				
				$this->_redirect("shopeditor/itemmanager");
			}
			else
			{				
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
	
	public function deleteitemAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();

		if($this->_request->isPost())
		{				
			$id = $this->_request->getParam("id");
			$md = new Models_Item();
			$obj = $md->_getByKey($id);
			
			$md->_delete($id);
			Models_Log::insert($this->view->user->username, "act_delete_item", $obj->name);
			
			if($obj->image && is_file(ROOT_MEDIA_IMAGE_ITEM_ITEMGIFT.DS.$obj->image))
				unlink (ROOT_MEDIA_IMAGE_ITEM_ITEMGIFT.DS.$obj->image);
		}
	}


	public function itemdetailAction()
    {
        try
        {    
            $xmlDoc = Utility::openXML(XML_PATH);

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $this->view->item = ItemManager::GetInstance()->LoadItemByID($xmlDoc, $id);
                $this->view->item->limited /= 24;
                $this->view->button = "Update";
            }
            else
            {
                $this->view->item = new Item();
                $this->view->button = "Add";
            }
        }
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    
    public function exportpigAction()
    {
        try
        {
            $xmlDoc = Utility::openXML(XML_PATH);
            PigManager::GetInstance()->ExportToPHP($xmlDoc);   
        }
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    
    public function exportitemAction()
    {
        try
        {
            $xmlDoc = Utility::openXML(XML_PATH);
            ItemManager::GetInstance()->ExportToPHP($xmlDoc);   
        }
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
	
	public function getitemidAction()
	{
		try
		{
			$md = new Models_Item_Increment();
			$id = $md->getId();
			
			$newId = $id + 1;
			
			$md->update($newId);
			
			$this->view->newId = $newId;
		}
		catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
}
?>
