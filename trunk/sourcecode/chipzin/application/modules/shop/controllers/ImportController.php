<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS.'Models_S_Import_GetArray.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS.'Models_S_Import_Logic.php';
class Shop_ImportController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','update','delete');
	}
	public function preDispatch()
	{
		parent::preDispatch();
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function indexAction() {
		
		if ($this->_request->isPost ()) {
			
			$mdArr= new Models_S_Import_GetArray();
			$mdLogic=new Models_S_Import_Logic();
			
			$file11 = $_FILES ['file1'];
			$file12 = $_FILES ['file2'];
			$file13 = $_FILES ['file3'];
			$file14 = $_FILES ['file4'];
								
			if($file11 ['name']==null || $file12['name']==null)
			{
			$this->view->errMsg="Có lỗi ! Phải đủ cả 2 file !";
					 return;
			}
			
		if ($file11 ['name']) {
					
					if($file11['type']!=='application/octet-stream' )
					{
						print_r($file11['type']);
						$this->view->errMsg="Có lỗi ! File phải là dạng .xfj";
					 return;
					}
					else
					{
					$dest1File = ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_import' . DS.'shop.xfj';
					move_uploaded_file ( $file11 ['tmp_name'], $dest1File );
					
					$arrShop=$mdArr->shop($dest1File);
					$kq1=$mdLogic->Shop($arrShop);
				}
					
				
				}
				
				if ($file12 ['name']) {
									
					
				 if (strpos ( $file12 ['name'], 'Type.def.php' ) !== FALSE)
					{
						$dest2File = ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_import' . DS.'type.php';
					move_uploaded_file ( $file12 ['tmp_name'], $dest2File );

				$arrItem=$mdArr->item();
				$kq2=$mdLogic->Item($arrItem);
				
					}
						else
						{
							$this->view->errMsg="Có lỗi ! File name : Type.def.php";
							return ;
						}
									
					}
					
					
					if ($file13 ['name']) {
				if (strpos ( $file13 ['name'], 'ShopHero.conf.php' ) !== FALSE) {
					$dest3File = ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_import' . DS . 'hero.php';
					move_uploaded_file ( $file13 ['tmp_name'], $dest3File );
					
					$arrHero = $mdArr->hero($dest3File);
					
				
				} else {
					$this->view->errMsg = "Có lỗi ! File name : ShopHero.conf.php";
					return;
				}
			}else $this->view->errMsg = "Có lỗi ! Chưa có ShopHero.conf.php";
			
			if ($file14 ['name']) {
				if (strpos ( $file14 ['name'], 'ShopSoldier.conf.php' ) !== FALSE) {
					$dest4File = ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_import' . DS . 'solider.php';
					move_uploaded_file ( $file14 ['tmp_name'], $dest4File );
					
					$arrSol = $mdArr->soldier($dest4File);
									
				} else {
					$this->view->errMsg = "Có lỗi ! File name : ShopSoldier.conf.php";
					return;
				}
			}else $this->view->errMsg = "Có lỗi ! Chưa có ShopHero.conf.php";
			
		
			
			if($arrHero!=null && $arrSol!=null)
			{
				
				$kq3= $mdLogic->updatelevel($arrHero,$arrSol);
			}
			
			
			//print_r($kq1.$kq2.$kq3);
			if($kq1==1 && $kq2==1 && $kq3==1)
			{
				$this->view->msg="Thành công !";
							
			}
		
		}
	}
	
}
