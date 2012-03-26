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
    ///////////////////////
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
            $form->_requestToForm($this);
            $data = $md->_filter($form->obj, "ID ASC", ($pageNo - 1) * $items, $items);
            $count = $md->_count(null);
            $this->view->arrNextCamp = array();
            foreach ($data as $value) {
                $this->view->arrNextCamp[$value->ID] = $md->getNextCamp($value->ID);
            }
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
    public function updateworldmapAction()
    {
        try {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNorender();
            $id = $this->_request->getParam("id");
            $desc2 = $this->_request->getParam("desc2");
            $md = new Models_Campaign();
            $mdw = new Models_WorldMap();

            $obj = new Obj_Campaign();
            $obj->ID = $id;
            $obj->Name = $md->fetchname($id);
            $obj->WorldMap = $mdw->searchname($desc2);
            $md->update($obj);
            Models_Log::insert($this->view->user->username, "act_update_Campaign", $obj->
                name);

            echo "Update thanh cong";
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    public function updatetypeAction()
    {
        try {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNorender();
            $id = $this->_request->getParam("id");
            $desc3 = $this->_request->getParam("desc3");
            $md = new Models_Campaign();
            $mdw = new Models_WorldMap();
            $data = $md->fetchone($id);
            $obj = new Obj_Campaign();

            $obj->ID = $id;
            $obj->Name = $data['Name'];
            $obj->WorldMap = $data['WorldMap'];
            if ($desc3 == "Map")
                $obj->TypeID = 1;
            else
                $obj->TypeID = 2;
            $md->update($obj);
            Models_Log::insert($this->view->user->username, "act_update_Campaign", $obj->
                name);

            echo "Update thanh cong";
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    public function updateAction()
    {
        try {
            $mdw = new Models_WorldMap();
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNorender();
            $id = $this->_request->getParam("id");
            $desc = $this->_request->getParam("desc");
            $wm = $this->_request->getParam("select");
            $md = new Models_Campaign();
            $obj = new Obj_Campaign();
            $obj->ID = $id;
            $obj->Name = $desc;
            if ($wm == null) {
                echo "Chưa nhập dữ liệu listbox";
                return;
            } else
                $obj->WorldMap = $mdw->searchname($wm);

            $md->update($obj);
            Models_Log::insert($this->view->user->username, "act_update_Campaign", $obj->
                name);
            echo "Update thanh cong";
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    public function addAction()
    {
        try {
            $mdw = new Models_WorldMap();
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNorender();
            $wm = $_POST[select];
            $desc = $_POST[decs];
            $nc = $_POST[select3];
            $type = $_POST[select2];
            $desc = $_POST[decs];
            $obj = new Obj_Campaign();
            if ($wm == null) {
                echo "Chưa nhập dữ liệu listbox";
                return;
            } else
                $obj->WorldMap = $mdw->searchname($wm);
            $obj->Name = $desc;
            $obj->NeedCamp = $nc;
            if ($type == "Map")
                $obj->TypeID = 1;
            else
                $obj->TypeID = 2;
            $md = new Models_Campaign();
            echo "ok";
            try {
                $md->insert($obj);
            }
            catch (exception $ex) {

            }
            Models_Log::insert($this->view->user->username, "act_insert_Campaign", $obj->
                name);
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }

    ///////////////////////////////////////
    /////////////////Thaonx//////////////

    /**************************************/
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
            $result = array('msg' => '1', 'CampID' => $id); 
            echo json_encode($result);           
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            $result = array('msg' => $ex->getMessage(), 'CampID' => "");
            echo json_encode($result); 
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
        
    }
    /**************************************/
    public function editAction()
    {
        try {
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
            require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
                DS . 'Models_Worldmap.php';


            ///////Lấy Campaign//////////
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

            ///////Lấy danh sách Battle ///////////
            //$mdbattle = new Models_Battle();

            ///////Lấy danh sách Layout//////////
            $mdlayout = new Models_Layout();
            $this->view->arrlayout = $mdlayout->getLayout();
            //print_r($this->view->arrlayout);
            ///////Lấy danh sách Award//////////
            $mdawardtype = new Models_Award_Type();
            $this->view->arrawardtype = $mdawardtype->getAwardtype();
            ////

            ///////Đối với mỗi battle//////
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


            ///////Lấy Award - ThaoNX////////////

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
    /**************************************/
}
