<?php
require_once ROOT_APPLICATION_CONTROLLERS . DS . 'BaseController.php';
require_once ROOT_LIBRARY_UTILITY . DS . 'utility.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Log.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'localite' . DS . 'models' . DS . 'Models_L_Download.php';
class Localite_DownloadController extends BaseController
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
			
            $md_Down = new Models_L_Download();
   
            
            $data = $md_Down->getdata();
            $count = count($data);
   
            
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
                         
             $url= ROOT."\Export".DS.$id;
             unlink($url);
             Models_Log::insert( $this->view->user->username, "delete file $url");
          
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
}