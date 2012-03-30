<?php
require_once ROOT_APPLICATION_CONTROLLERS . DS . 'BaseController.php';
require_once ROOT_LIBRARY_UTILITY . DS . 'utility.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Log.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Backup.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Restore.php';

class Campaign_BkrtController extends BaseController {
	public function _setUserPrivileges() {
		return array ('index' );
	}
	
	public function preDispatch() {
		parent::preDispatch ();
		
		if (! $this->hasPrivilege ())
			$this->_redirect ( "/error/permission" );
	}
	
	public function  indexAction()
	{
		try{
		
			if($this->_request->getMethod() == 'POST')
            {
            $btbk=$this->_request->getParam("btnbk");
            $btrt=$this->_request->getParam("btnrt");
                        
            if($btbk)
            {
            $mdbk= new Models_C_Backup();
           $kq= $mdbk->create();
           if ($kq==1)
           $this->view->msg="Thành công";
           Models_Log::insert ( $this->view->user->username, "Backup data" );
            }
            
            if($btrt)
            {
            	$mdrt= new Models_C_Restore();
            	$file11 = $_FILES ['file2'] ;
            
            	$kq2=$mdrt->restore($file11['tmp_name']);
            if($kq2==1)
            {
             $this->view->msg="Thành công";
           Models_Log::insert ( $this->view->user->username, "Restore data" );
            }
            }
            }
		
		}
	catch ( Exception $ex ) {
			$this->view->errMsg = $ex->getMessage ();
			Utility::log ( $ex->getMessage (), $ex->getFile (), $ex->getLine () );
		}
	}
}