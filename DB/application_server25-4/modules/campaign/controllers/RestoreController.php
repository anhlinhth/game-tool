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
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
	DS . 'Models_Restore.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' .
	DS . 'Models_C_Restore.php';	
require_once ROOT_LIBRARY_UTILITY . DS . 'utility.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Log.php';
class Campaign_RestoreController extends BaseController
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
			
            $md = new Models_Restore();
   
            
            $data = $md->getdata();
            $count = $md->count();
   
            $this->view->data = $data;
            $this->view->items = $items;
            $this->view->page = $pageNo;
            $this->view->totalRecord = $count;
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
	 public function deleteAction()
    {
    	
        try {
			 $this->_helper->layout->disableLayout();
             $this->_helper->viewRenderer->setNorender();
             $id = $this->_request->getParam("id");
             $url = $this->_request->getParam("url");
             $mdr = new Models_Restore();
             $mdr->delete($id);
            //echo ROOT."\application\modules\campaign\backup_data\Battle.conf.php.txt";
            
            
      //       echo $url;
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    
 	public function restoreAction()
    {
        try {
			 $this->_helper->layout->disableLayout();
             $this->_helper->viewRenderer->setNorender();
           	 $mdrt= new Models_C_Restore();
           	 $id = $this->_request->getParam("id");
 
             $mdr = new Models_Restore();
    			
             $file11=$mdr->getLink($id);
             //echo $file11;
             $kq2=$mdrt->restore($file11);
             if ($kq2==1)
             echo "Success";
             Models_Log::insert ( $this->view->user->username, "Restore data" );
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
}
