<?php
require_once ROOT_APPLICATION_CONTROLLERS . DS . 'BaseController.php';
require_once ROOT_LIBRARY_UTILITY . DS . 'utility.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Log.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_import_arr.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_importlogic2.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Backup.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_DeleteData.php';



class Campaign_Import2Controller extends BaseController {
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
				
				
				
				
				$mdAr = new Models_C_import_arr();
				$mdLogic= new Models_C_importlogic2();
				$mdBK=new Models_C_Backup();
				$mdDelete=new Models_C_DeleteData();
				
				$arrMap=null;
				$arrBattle=null;
				
				
					
				$file11 = $_FILES ['file1'];
				$file12 = $_FILES ['file2'];
				
			
				
				if ($file11 ['name']) {
					$pos = strpos ( $file11 ['name'], 'apBattle.conf.php' );
					
					if($pos == false)
					{
						
						$this->view->errMsg="Có lỗi ! File name : MapBattle.conf.php";
					 return;
					}
					else
						$arrMap = $mdAr->map( $file11 ['tmp_name'] );
					
				
				}
				
				if ($file12 ['name']) {
									
					
				 if (strpos ( $file12 ['name'], 'attle.conf.php' ) !== FALSE)
					{
						$arrBattle = $mdAr->battle( $file12 ['tmp_name'] );
						}
						else
						{
							$this->view->errMsg="Có lỗi ! File name : Battle.conf.php";
							return ;
						}
									
					}
					
					if($arrBattle!=null && $arrMap!=null)
					{
						$mdBK->create();
						$mdDelete->deltele();
					}
					else {
						$this->view->errMsg="Có lỗi ! Phải đủ cả 2 file";
							return ;
					}
					
					
					if($arrMap!=null)
					{
						$kt1=$mdLogic->map($arrMap);
						
					}
			if ($arrBattle!=null)
					{
						$kt2=$mdLogic->battle($arrBattle);
						
					}
					
					if($kt1==1 && $kt2==1)
					{
						$this->view->msg="Thành công";
						
						
					}
					else {
						$this->view->errMsg="Có lỗi trong quá trình import ! Hãy thử lại.";
							return ;
						
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