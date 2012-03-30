<?php
require_once ROOT_APPLICATION_CONTROLLERS . DS . 'BaseController.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'models' .
    DS . 'Models_Campaign.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'models' .
    DS . 'Models_WorldMap.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'form' .
    DS . 'Forms_Campaign.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'object' .
    DS . 'Obj_Base.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
	DS . 'Models_Award.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
	DS . 'Models_Layout.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
	DS . 'Models_Battle.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
	DS . 'Models_Award_type.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
	DS . 'Models_Battle_Soldier.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
	DS . 'Models_Soldier.php';

require_once ROOT_LIBRARY_UTILITY . DS . 'utility.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Log.php';
class Campaign_CampaignController extends BaseController
{
    public function _setUserPrivileges()
    {
        return array('index');
    }

    public function preDispatch()
    {
        parent::preDispatch();

        if (!$this->hasPrivilege())
            $this->_redirect("/error/permission");
    }
    /////////////////Thaonx//////////////
    public function indexAction()
    {
        try {

            $pageNo = $this->_request->getParam("page");
            $items = $this->_request->getParam("items");

            if ($pageNo == 0)
                $pageNo = 1;
            if ($items == 0)
                $items = DEFAULT_ITEM_PER_PAGE;

            $md = new Models_Campaign();
            $form = new Forms_Campaign();
            //$form->_requestToForm($this);khong dung duoc vi trung ID va Name
            if ($this->_request->isPost()) {// search
                $form->obj->ID = $_POST["S_ID"];
                $form->obj->WorldMap= $_POST["S_WorldMap"];
            }
            
            $data = $md->_filter($form->obj, "ID ASC", ($pageNo - 1) * $items, $items);
            $count = $md->_count(null);
            $this->view->arrNextCamp = array();
            foreach ($data as $value) {
                $this->view->arrNextCamp[$value->ID] = $md->getNextCamp($value->ID);
            }
            $this->view->obj = $form->obj;
            $this->view->data = $data;
            $this->view->items = $items;
            $this->view->page = $pageNo;
            $this->view->totalRecord = $count;
            $mdWorldMap = new Models_WorldMap();
            $this->view->arrWorldMap = $mdWorldMap->fetchall();
            $this->view->arrCampaign = $md->fetchall();
            $this->view->arrMapType = $md->getAllMapType();
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }

    ///////////////////////////////
    public function deleteAction()
    {       
        try {
            if ($this->_request->isPost()) {                 
                $this->_helper->layout->disableLayout();
                $this->_helper->viewRenderer->setNorender();
                $campID = $_POST["CampID"];               
                $md = new Models_Campaign();
                $md->delete($campID);
                echo "1";
            }

        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    
    ///////////////////////////////
    /*
     * Neu khong co ID thi Insert
     * */
    public function saveAction()
    {
        try {

            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNorender();

            $form = new Forms_Campaign();
            $form->_requestToForm($this);
            if (empty($form->obj->NeedCamp))
                $form->obj->NeedCamp = null;

            $mdCamp = new Models_Campaign();

            if (empty($form->obj->ID)) {
                $id = $mdCamp->_insert($form->obj);
                $form->obj->ID = $id;
            } else {
                $mdCamp->_update($form->obj);
                $mdCamp->resetNextCamp($form->obj->ID);
            }

            $arrNextCamp = $_POST['NextCamp'];
            if (!empty($arrNextCamp)) {
                foreach ($arrNextCamp as $row) {
                    if(empty($row))
                        continue;
                    $obj = new Obj_Base();
                    $obj->CampID = $form->obj->ID;
                    $obj->NextCamp = empty($row) ? null : $row;
                    $mdCamp->insertNextCamp($obj);
                }
            }
            $result = array('msg' => '1', 'CampID' => $id,'Name'=>$form->obj->Name); 
            echo json_encode($result);           
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            $result = array('msg' => $ex->getMessage(), 'CampID' => "");
            echo json_encode($result); 
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
        
    }
    
    ///////////////////////////////
    public function editAction()
    {
        try {
            ///////Láº¥y Campaign//////////
            $mdCamp = new Models_Campaign();
            $id = $this->_request->getParam("id");
            if (!isset($id)) {
                $campaign = $mdCamp->getTopCampaign();
                $this->_redirect("/campaign/campaign/edit/id/$campaign->ID");
            }

            //$this->view->campaign=$mdCamp->getAllCampaign();

            $this->view->arrCampaign = $mdCamp->getAllCampaign();
            $this->view->campaign = $mdCamp->getCampaignById($id);

            //var_dump($campaign);

            ///////Láº¥y danh sÃ¡ch Battle ///////////
            //$mdbattle = new Models_Battle();

            ///////Láº¥y danh sÃ¡ch Layout//////////
            $mdlayout = new Models_Layout();
            $this->view->arrlayout = $mdlayout->getLayout();
            //print_r($this->view->arrlayout);
            ///////Láº¥y danh sÃ¡ch Award//////////
            $mdawardtype = new Models_Award_Type();
            $this->view->arrawardtype = $mdawardtype->getAwardtype();
            ////

            ///////Ä�á»‘i vá»›i má»—i battle//////
            $mdB_layout = new Models_Soldier();
            $this->view->arrSoldier = $mdB_layout->getAllSoldier();
            $mdB = new Models_Battle();
            $this->view->arrbattle = $mdB->getBattle($id);

            $mdBS = new Models_Battle_Soldier();
            $this->view->arrBattleSolider = array();
            $arrPoint = array();
            foreach ($this->view->arrbattle as $row) {

                $strPoint = $row->Point;
                $strPoint = substr($strPoint, 1, strlen($strPoint) - 2);
                $arr = explode(',', $strPoint);
                $arrPoint[$row->ID] = $arr;
                $this->view->arrBattleSolider[$row->ID] = $mdBS->getbattle_soldier($row->ID);
            }
            $this->view->arrPoint = $arrPoint;
            $arrbattle = $this->view->arrbattle;


            ///////Láº¥y Award - ThaoNX////////////

            $md_award = new Models_Award();
            $this->view->arrAwardType = $md_award->getAwardType();
            $this->view->arraward = array();

            foreach ($this->view->arrbattle as $row) {
                $idbattle = $row->ID;

                $this->view->arraward[$idbattle] = $md_award->getAward($idbattle);

            }


        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    /**************************************/
    public function loadlayoutAction()
    {
        try {
            require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
                DS . 'Models_Layout.php';
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNorender();
            $mdlayout = new Models_Layout();
            $id = $_POST['id'];
            $layout = array();
            $layout = $mdlayout->getLayoutById($id);
            //echo json_encode($layout);
            $strPoint = $layout[0]->Point;

            $strPoint = substr($strPoint, 1, strlen($strPoint) - 2);
            $arrPoint = explode(',', $strPoint);
            $arr = array();
            foreach ($arrPoint as $key => $value) {
                $arr["point" . $key] = $value;
            }


            echo json_encode($arr);

        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());

        }
    }
}
