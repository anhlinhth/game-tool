<?php
require_once ROOT_APPLICATION_CONTROLLERS . DS . 'BaseController.php';
require_once ROOT_LIBRARY_UTILITY . DS . 'utility.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Log.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_import.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_import_logic.php';

class Campaign_ImportController extends BaseController {
	public function _setUserPrivileges() {
		return array ('index' );
	}
	
	public function preDispatch() {
		parent::preDispatch ();
		
		if (! $this->hasPrivilege ())
			$this->_redirect ( "/error/permission" );
	}
	public function indexAction() {
		try {
			
			if ($this->_request->isPost ()) {
				$mdEx = new Models_C_import ();
				$mdLogic= new Models_C_import_logic();
				
				$arrM=null;
				$arrS=null;
				$start = $_POST ["start"];
				$end = $_POST ["end"];
				
				if($start==null)
				$start=2;
				
				if ($end==null)
				$end=1000000;
				
				$file11 = $_FILES ['file1'];
				$file12 = $_FILES ['file2'];
				
				if ($file11 ['name']) {
					$pos = strpos ( $file11 ['name'], '.xls' );
					if($pos == false)
					{
						$this->view->errMsg="Định dạng cho phép là : xls";
					 return;
					}
					else
						$arrM = $mdEx->importMaps ( $file11 ['tmp_name'], $start, $end );
					
				
				}
				
				if ($file12 ['name']) {
					if (strpos ( $file12 ['name'], '.xlsx' ) !== false) {
						return "Định dạng cho phép là : xls";
					} else if (strpos ( $file12 ['name'], '.xls' ) !== FALSE)
					{
						$arrS = $mdEx->importSoldier ( $file12 ['tmp_name'] );
						}
					else
					{
						$this->view->errMsg="Định dạng cho phép là : xls";
						return ;
					}
									
				}
				
				
			if($arrS!= null)
				{
					
					$mdLogic->logicSoldier($arrS);
					Models_Log::insert ( $this->view->user->username, "Import Soldiers" );
				}
				
				if($arrM !=null)
				{
					var_dump($arrM);
					die();
					$mdLogic->logicCamp($arrM);
					Models_Log::insert ( $this->view->user->username, "Import Maps" );
				}
				
			
			
			
			

			}
		} 

		catch ( Exception $ex ) {
			$this->view->errMsg = $ex->getMessage ();
			Utility::log ( $ex->getMessage (), $ex->getFile (), $ex->getLine () );
		}
	}

}
?>