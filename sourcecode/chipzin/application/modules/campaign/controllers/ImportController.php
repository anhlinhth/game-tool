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
					if(strpos ( $file11 ['name'], '.xlsx' )){
						
						$this->view->errMsg="Có lỗi ! Định dạng cho phép là : xls";
					 return;
					}
					if($pos == false)
					{
						//var_dump($file11['name']);
			//die();
						$this->view->errMsg="Có lỗi ! Định dạng cho phép là : xls";
					 return;
					}
					else
						$arrM = $mdEx->importMaps ( $file11 ['tmp_name'], $start, $end );
					
				
				}
				
				if ($file12 ['name']) {
					
				if(strpos ( $file11 ['name'], '.xlsx' )){
						
						$this->view->errMsg="Có lỗi ! Định dạng cho phép là : xls";
					 return;
					}
					
					if (strpos ( $file12 ['name'], '.xlsx' ) !== false) {
						return "Có lỗi ! Định dạng cho phép là : xls";
					} else if (strpos ( $file12 ['name'], '.xls' ) !== FALSE)
					{
						$arrS = $mdEx->importSoldier ( $file12 ['tmp_name'] );
						}
					else
					{
						$this->view->errMsg="Có lỗi ! Định dạng cho phép là : xls";
						return ;
					}
									
				}
				
				
				
				if($arrM!=null)
				{
					if ($arrM==1)
					{
						$this->view->errMsg="Có lỗi ! Kiểm tra lại thông tin world map, trận đánh không thể không có world map !";
						return ;
					}
					
				if ($arrM==2)
					{
						$this->view->errMsg="Có lỗi ! Kiểm tra lại thông tin làng, thiếu thông tin tên campaign hoặc type map  ! ";
						return ;
					}
				if ($arrM==3)
					{
						$this->view->errMsg="Có lỗi ! Kiểm tra lại thông tin tên trận đánh, layout các trận đánh. Tất cả các vị trí không thể trống ! ";
						return ;
					}
				if ($arrM==4)
					{
						$this->view->errMsg="Có lỗi ! Kiểm tra lại tên các trận đánh. Không thể không có tên trận đánh !";
						return ;
					}
				if ($arrM==5)
					{
						$this->view->errMsg="Có lỗi ! Kiểm tra lại thông tin các trận đánh. Không thể không có layout hoặc tất cả các vị trí trống trong trận đánh !";
						return ;
					}
				
					
				}
				
				
				
				if ($arrS!=null)
				{
				if ($arrM==1)
					{
						$this->view->errMsg="Có lỗi ! Kiểm tra lại thông tin Soldier, Name không được bỏ trống !";
						return ;
					}
					
				if ($arrM==2)
					{
						$this->view->errMsg="Có lỗi ! Kiểm tra lại thông tin Soldier, ID không được bỏ trống ! ";
						return ;
					}
					
				}
				
				
				
				
			if($arrS!= null)
				{
					
					
				$kq1=$mdLogic->logicSoldier($arrS);
					if($kq1==1)
					{
					$this->view->msg="Thành công";
					Models_Log::insert ( $this->view->user->username, "Import Soldiers" );
					}
					
				}
				
				if($arrM !=null)
				{
					//var_dump($arrM);
					//die();
					
					$kq2=$mdLogic->logicCamp($arrM);
					if($kq2==1)
					{
					$this->view->msg="Thành công";
					Models_Log::insert ( $this->view->user->username, "Import Maps" );
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
?>