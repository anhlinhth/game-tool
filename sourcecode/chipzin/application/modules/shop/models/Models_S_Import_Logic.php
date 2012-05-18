<?php 
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_ibshop.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_ibshop_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_require.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_shop_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_shop.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_unblock.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_itemshop.php';

require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'object' . DS . 'Obj_S_ibshop.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'object' . DS . 'Obj_S_ibshop_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'object' . DS . 'Obj_S_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'object' . DS . 'Obj_S_require.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'object' . DS . 'Obj_S_shop_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'object' . DS . 'Obj_S_shop.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'object' . DS . 'Obj_S_unblock.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'object' . DS . 'Obj_ItemShop.php';

class Models_S_Import_Logic {
	
	function Item($arr)
	{
		
		$mdItem= new Models_S_item();
		
		$objItem=new Obj_S_item();
		
		foreach ($arr as $key=>$value)
		{
			$objItem->ID=$value;
			$objItem->NameSV=$key;
			
			$kq = $mdItem->hit($objItem);
			
		}
		
		return 1;
	}
	
	function Shop($arr)
	{
		$mdIbshop=new Models_S_ibshop();
		$mdIbshop_item=new Models_S_ibshop_item();
		$mdRequire=new Models_S_require();
		$mdUnblock=new Models_S_unblock();
		$mdShop= new Models_S_shop();
		$mdShop_item=new Models_S_shop_item();
		$mdItemshop=new Models_S_itemshop();
		
		$objIbshop=new Obj_S_ibshop();
		$objIbshop_item=new Obj_S_ibshop_item();
		$objShop=new Obj_S_shop();
		$objShop_item=new Obj_S_shop_item();
		$objRequire=new Obj_S_require();
		$objUnblock=new Obj_S_unblock();
		$objItemshop=new Obj_ItemShop();
		
		
		//--deleteall----------------------------------------------------------------------------
		$mdShop_item->deleteall();
		$mdIbshop_item->deleteall();
		$mdIbshop->deleteall();
		$mdShop->deleteall();
		$mdRequire->deleteall();
		$mdUnblock->deleteall();
		$mdItemshop->deleteall();
		//---------------------------------------------------------------------------------------
		
		/*  WARNING - level  */
		//----itemshop----------------------------------------------------------------------------
		foreach ($arr['items'] as $k_items => $val_items)
		{
			
			$objItemshop->ID=$k_items;			
			$objItemshop->Entity=$val_items['entity'];			
			$objItemshop->Item=$val_items['item'];
			$objItemshop->Icon=$val_items['icon'];
			$objItemshop->Title=$val_items['title'];
			$objItemshop->Level=null;
			
			 $mdItemshop->insert($objItemshop, $val_items['kind']);
			
			//require la khoa ngoai
			if($val_items['require']!=null)
			{
				foreach ($val_items['require'] as $k_re => $val_re)
				{	
					$objRequire=null;
					$objRequire->ItemShopID=$k_items;
					$objRequire->Value=$val_re;
					
					$ktreq = $mdRequire->insert($objRequire,$k_re);
					
				}
			}
			
			//unblock la khoa ngoai
		if($val_items['unblock']!=null)
			{
				foreach ($val_items['unblock'] as $k_un => $val_un)
				{	
					$objUnblock=null;
					$objUnblock->ItemShopID=$k_items;
					$objUnblock->Value=$val_un;
					$ktunblock=$mdUnblock->insert($objUnblock,$k_un);
					
				}
			}
			
		}
		//----------------------------------------------------------------------------------------
		
		//---ib_shop-------------------------------------------------------------------------------
		foreach ($arr['ib_shop'] as $k_tab => $val_tab)
		{
			//---tab----------------------------------------
			$objIbshop=null;
			
			$objIbshop->Name=$k_tab;
			$objIbshop->Resclass=$val_tab['resClass'];
			$objIbshop->TabIndex=$val_tab['tapIndex'];
			$objIbshop->Title=$val_tab['title'];
			
			$idIBshop=$mdIbshop->insert($objIbshop);
			
			
				//---item_ibshop--------------
				foreach ($val_tab['data'] as $val_itemibshop)
				{
					$objIbshop_item=null;
					
					$objIbshop_item->IbShopID=$idIBshop;
					$objIbshop_item->ItemID=$val_itemibshop;
					
					$ktibshop=$mdIbshop_item->insert($objIbshop_item);
					
				}
				//---------------------------
			//-----------------------------------------------
		}
		//-----------------------------------------------------------------------------------------
		
		
		//---unset--------------------------------------------------------------------------------
		unset($arr['items']);
		unset($arr['ib_shop']);
		//----------------------------------------------------------------------------------------
		
		
		//---other shop----------------------------------------------------------------------------
		foreach ($arr as $k_ots => $val_ots)
		{
			//---shop----------------------------------------
			$objShop=null;
			
			$objShop->Name=$k_ots;
			
			$idShop=$mdShop->insert($objShop);
			
				//---item_shop--------------
				foreach ($val_ots as $val_item_shop)
				{
					$objShop_item=null;
					
					$objShop_item->ShopID=$idShop;
					$objShop_item->ItemID=$val_item_shop;
					
					$ktshop_item=$mdShop_item->insert($objShop_item);
					
				}
				//---------------------------
			//-----------------------------------------------
		}
		//-----------------------------------------------------------------------------------------
		
		return 1;
	}
	
	function updatelevel($arrHero,$arrSol)
	{
		$mdItemshop=new Models_S_itemshop();
		
		$objItemshop=new Obj_ItemShop();
		
		
		
		//--hero------------------------------------
		foreach ($arrHero as $k_Hero => $val_Hero)
		{
			$objItemshop->ID=$k_Hero;
			$objItemshop->Level=$val_Hero['level'];

			$kt1=$mdItemshop->updateLevel($objItemshop);
			
		}
		//------------------------------------------
		
		
		//--Sol-------------------------------------
	foreach ($arrSol as $k_Sol => $val_Sol)
		{
			$objItemshop->ID=$k_Sol;
			$objItemshop->Level=$val_Sol['level'];

			$kt2=$mdItemshop->updateLevel($objItemshop);
			
		}
		//------------------------------------------
		return 1;
	}
	
}
?>