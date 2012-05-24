<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS.'Models_S_Import_GetArray.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS.'Models_S_Import_Logic.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_version.php';

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
			
			$fileBuilding=$_FILES ['fileBuilding'];
			$fileItem=$_FILES ['fileItem'];
			$fileQuantity=$_FILES ['fileQuan'];
								
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
			
		//------------------------------fix ....
			
		if ($fileBuilding ['name']) {
				if (strpos ( $fileBuilding ['name'], 'ShopBuilding.conf.php' ) !== FALSE) {
					$destBuilding = ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_import' . DS . 'building.php';
					move_uploaded_file ( $fileBuilding ['tmp_name'], $destBuilding );
					
					$arrShopSV['ShopBuilding'] = $mdArr->building($destBuilding);
									
				} else {
					$this->view->errMsg = "Có lỗi ! File name : ShopBuilding.conf.php";
					return;
				}
			}else $this->view->errMsg = "Có lỗi ! Chưa có ShopBuilding.conf.php";
			
			if ($fileItem ['name']) {
				if (strpos ( $fileItem ['name'], 'ShopItem.conf.php' ) !== FALSE) {
					$destItem = ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_import' . DS . 'item.php';
					move_uploaded_file ( $fileItem ['tmp_name'], $destItem );
					//print_r($mdArr->shopitem($destItem));die();
					$arrShopSV['ShopItem'] = $mdArr->shopitem($destItem);
									
				} else {
					$this->view->errMsg = "Có lỗi ! File name : ShopItem.conf.php";
					return;
				}
			}else $this->view->errMsg = "Có lỗi ! Chưa có ShopItem.conf.php";
			
			if ($fileQuantity['name']) {
				if (strpos ( $fileQuantity ['name'], 'ShopItemQuantity.conf.php' ) !== FALSE) {
					$destQuantity = ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_import' . DS . 'quantity.php';
					move_uploaded_file ( $fileQuantity ['tmp_name'], $destQuantity );
					
					$arrShopSV['ShopItemQuantity'] = $mdArr->quantity($destQuantity);
									
				} else {
					$this->view->errMsg = "Có lỗi ! File name : ShopItemQuantity.conf.php";
					return;
				}
			}else $this->view->errMsg = "Có lỗi ! Chưa có ShopItemQuantity.conf.php";
			
			
		
			
			if($arrShopSV['ShopItemQuantity']!=null && $arrShopSV['ShopItem'] != null && $arrShopSV['ShopBuilding'] != null && $arrHero!=null && $arrSol!=null)
			{
				$arrShopSV['ShopHero']=$arrHero;
				$arrShopSV['ShopSoldier']=$arrSol;
				$kq3 = $mdLogic->updateItemshop($arrShopSV);
				$kq4 = $mdLogic->shopServer($arrShopSV);
				
			}
			else $this->view->errMsg = "Có lỗi ! Thử lại!";
		//--------------------------------
			
			
			
			
			//print_r($kq1.$kq2.$kq3);
			if($kq1==1 && $kq2==1 && $kq3==1 && $kq4==1)
			{
				$this->view->msg="Thành công !";
					$mdver= new Models_S_version();
					$mdver->insert();		
			}
		
		}
	}
	
}
