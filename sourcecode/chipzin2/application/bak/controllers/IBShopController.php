<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_CONFIG.DS.'AppConstant.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Ibs_Shop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Ibs_Tab.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Ibs_Tab_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Ibs_Tab_Item_Type.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Ibs_Tab_Status.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Ibs_Currency_Type.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Ibs_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Ibs_Pig.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_LIBRARY_UTILITY.DS.'jqgrid_helper.php';
//require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'PigManager.php';
//require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'ItemManager.php';

/**
* IBShop class controller
* @author KietMA
*/
class IBShopController extends BaseController
{
    public function _setUserPrivileges()
    {
        return array('index', 'listshop','arrange','loadtab','tabposition','tabdetail', 
            'tabdetailpos', 'itemoperation', 'suggestion', 'getshop', 'operationshop', 'listtab', 'operationtab');
    }
    
    public function preDispatch()
    {
        parent::preDispatch();
        
        if(!$this->hasPrivilege())
            $this->_redirect ("/error/permission");
    }
    
    public function indexAction()
    {
        if(Utility::checkPrivilege($this->view, 'ibshop', 'listshop'))
            $this->_redirect ("/ibshop/listshop");
        if(Utility::checkPrivilege($this->view, 'ibshop', 'arrange'))
            $this->_redirect ("/ibshop/arrange");
    }
    
    public function listshopAction()
    {
        $modelTabStatus = new Models_Ibs_Tab_Status();
        $modelTabItemType = new Models_Ibs_Tab_Item_Type();
        
        $data['itemType'] = $modelTabItemType->getAll();
        $data['tabStatus'] = $modelTabStatus->getAll();
        
        $this->view->data = $data;
    }
    
    /**
    * Get view of shop
    * 
    */
    public function arrangeAction()
    {
        $modelShop = new Models_Ibs_Shop();
        $modelCurrencyType = new Models_Ibs_Currency_Type();
        $modelTabItemType = new Models_Ibs_Tab_Item_Type();
        
        $data['shop'] = $modelShop->getAll();
        $data['currency'] = $modelCurrencyType->getAll();
        $data['itemType'] = $modelTabItemType->getAll();
        
        $this->view->data = $data;
    }
    
    /**
    * Load tab in shop by shopid
    * @author KietMA
    */
    public function loadtabAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $shopId = $_POST['shopid'];
        
        if ($shopId == '')
        {
            return;
        }
        
        $modelTab = new Models_Ibs_Tab();
        $data = $modelTab->getTabByShop($shopId);
        
        echo json_encode($data);
    }
    
    /**
    * Set position for tab in shop
    * @author KietMA
    */
    public function tabpositionAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $shopid = $_POST['shopid'];
        $listTabs = $_POST['listtab'];
        
        $modelTab = new Models_Ibs_Tab();
        
        foreach($listTabs as $position => $tabId)
        {
            $modelTab->updatePosition($shopid, $tabId, $position);
        }
    }
    
    /**
    * Get tab detail
    * @author KietMA
    */
    public function tabdetailAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $tabid = $_POST['tabid'];
        
        $modelTabDetail = new Models_Ibs_Tab_Detail();
        $modelTabItemType = new Models_Ibs_Tab_Item_Type();
        $modelPig = new Models_Ibs_Pig();
        $modelItem = new Models_Ibs_Item();
        
        $data = $modelTabDetail->getByTab($tabid);
        $tabItemType = $modelTabItemType->getAll();
        
        $arrTmp = array();
        foreach($tabItemType as $dt)
        {
            $arrTmp[$dt['id']] = $dt;
        }
        $tabItemType = $arrTmp;
        unset($arrTmp);
        
        foreach($data as &$dataset)
        {
            $table = $tabItemType[$dataset['tab_item_type']]['table_map'];
            
            // Lay du lieu tuong ung voi Pig hoac Item
            switch($table)
            {
                case AppConstant::TBL_IBS_ITEM:
                    $item = $modelItem->getById($dataset['tab_item_id']);
                    $dataset['type'] = $tabItemType[$dataset['tab_item_type']]['name'];
                    $dataset['image'] = $item['image'];
                    $dataset['name'] = $item['name'];
                    break;
                case AppConstant::TBL_IBS_PIG:
                    $pig = $modelPig->getById($dataset['tab_item_id']);
                    $dataset['type'] = $tabItemType[$dataset['tab_item_type']]['name'];
                    $dataset['image'] = $pig['image'];
                    $dataset['name'] = $pig['name'];
                    break;
            }
        }
        
        echo json_encode($data);
    }
    
    /**
    * Set postion for detail in tab
    * @author KietMA
    */
    public function tabdetailposAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $listTabDetails = $_POST['listtabdetail'];
        $modelTabDetail = new Models_Ibs_Tab_Detail();
        
        foreach($listTabDetails as $position => $id)
        {
            $modelTabDetail->updatePosition($id, $position);
        }
    }
    
    /**
    * Add / Edit / Save detail of item
    * @author KietMA
    */
    public function itemoperationAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $oper = $_POST['act'];
        switch($oper)
        {
            case 'edit':
                $modelTabDetail = new Models_Ibs_Tab_Detail();
                $modelTabDetail->update($_POST);
                break;
            case 'add':
                $modelTabDetail = new Models_Ibs_Tab_Detail();
                $latestId = $modelTabDetail->insert($_POST);
                echo $latestId;
                break;
        }
    }

    /**
    * Auto complete search
    * @author KietMA
    */
    public function suggestionAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        //$itemType;
        $type = $_POST['type'];
        $desc = $_POST['desc'];
        $table = '';
        
        $modelTabItemType = new Models_Ibs_Tab_Item_Type();
        $tabItemType = $modelTabItemType->getAll();
        
        foreach($tabItemType as $itemType)
        {
            if ($type == $itemType['id'])
            {
                $table = $itemType['table_map'];
                continue;
            }
        }
        
        // Lay du lieu tuong ung voi Pig hoac Item
        switch($table)
        {
            case AppConstant::TBL_IBS_ITEM:
                $modelItem = new Models_Ibs_Item();
                $item = $modelItem->searchLike(Models_Ibs_Item::COL_NAME, $desc);
                echo json_encode($item);
                break;
            case AppConstant::TBL_IBS_PIG:
                $modelPig = new Models_Ibs_Pig();
                $pig = $modelPig->searchLike(Models_Ibs_Pig::COL_NAME, $desc);
                echo json_encode($pig);
                break;
        }
    }
    
    /**
    * Get shops for jqgrid
    * @author KietMA
    */
    public function getshopAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $modelShop = new Models_Ibs_Shop();
        
        buildGridData(
            array(
                'model'   => $modelShop,
                'method'  => 'getShop',
                'pkid'    => 'id',
                'whereParam' => '',
                'columns' => array( 'id','shop_id_text','name')
            )
        );
    }

    /**
    * Add / edit shop
    * @author KietMA
    */
    public function operationshopAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $modelShop = new Models_Ibs_Shop();
        $action = $_POST['oper'];
        
        switch( $action ){
            case 'add' :
                $arr['shop_id_text'] = $_POST['shop_id_text'];
                $arr['name'] = $_POST['name'];
                $modelShop->insert($arr);
                Models_Log::insert($this->view->user->username, 'act_add_shop');
                break;
            case 'edit' :
                $arr['id'] = $_POST['id'];
                $arr['shop_id_text'] = $_POST['shop_id_text'];
                $arr['name'] = $_POST['name'];
                $modelShop->update($arr);
                Models_Log::insert($this->view->user->username, 'act_edit_shop');
                break;
            case 'del' :
                $id = $_POST['id'];
                // Neu co item trong tab, khong cho delete
                $modelTab = new Models_Ibs_Tab();
                $modelTab->deleteTabByShop($id);
                $modelShop->delete($id);
                Models_Log::insert($this->view->user->username, 'act_del_shop');
                break;
        }
    }
    
    public function listtabAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $model = new Models_Ibs_Tab();
        $whereParam = ' AND t.shop_id = ' . $_POST['shop_id'] ;
        
        buildGridData(
            array(
                'model'   => $model,
                'method'  => 'getTab',
                'pkid'    => 'id',
                'whereParam' => $whereParam,
                'columns' => array( 'id','shop_id','type', 'name', 'position', 'status')
            )
        );
    }
    
    public function operationtabAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $modelTab = new Models_Ibs_Tab();
        $action = $_POST['oper'];
        
        switch( $action ){
            case 'add' :
                $arr['shop_id'] = $_POST['shop_id'];
                $arr['type'] = $_POST['type'];
                $arr['name'] = $_POST['name'];
                $arr['position'] = $modelTab->countRowByShop($_POST['shop_id']);
                $arr['status'] = $_POST['status'];
                $modelTab->insert($arr);
                Models_Log::insert($this->view->user->username, 'act_add_tab');
                break;
            case 'edit' :
                $arr['id'] = $_POST['id'];
                $arr['shop_id'] = $_POST['shop_id'];
                $arr['type'] = $_POST['type'];
                $arr['name'] = $_POST['name'];
                $arr['position'] = $_POST['position'];
                $arr['status'] = $_POST['status'];
                $modelTab->update($arr);
                Models_Log::insert($this->view->user->username, 'act_edit_tab');
                break;
            case 'del' :
                $id = $_POST['id'];
                // Neu co item trong tab, khong cho delete
                $modelTab->delete($id);
                Models_Log::insert($this->view->user->username, 'act_del_tab');
                break;
        }
    }
}
?>
