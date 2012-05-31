<?php
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_version.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_ibshop.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_ibshop_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_require.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_shop_item.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_shop.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_unblock.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_itemshop.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_Type_Get.php';


class Models_S_Export_SetString
{

	public function shop_version_xfj() 
	{
		$mdShop = new Models_S_shop();
		$mdShopItem= new Models_S_shop_item();
		$mdItemshop = new Models_S_itemshop();
		$mdIbshop=new Models_S_ibshop();
		$mdIbshop_item=new Models_S_ibshop_item();
		$mdKind = new Models_S_Type_Get();
		$mdUnblock = new Models_S_unblock();
		$mdReq= new Models_S_require();
		
		$arr=array();
		
		//item---------------------------------------------------------
		$listItem = $mdItemshop->getAll();
		foreach ($listItem as $item)
		{
			$arrItem=array();
			
			//entity---------------------------------------------------
			if ($item['Entity'] != null)
			{
				$arrItem['entity']=$item['Entity'];
			}
			//---------------------------------------------------------
			
			//item-----------------------------------------------------
			if ($item['Item'] != null)
			{
				$arrItem['item']=$item['Item'];
			}
			//---------------------------------------------------------
			
			//kind-----------------------------------------------------
			$kind= $mdKind->getNameKind($item['Kind']);
			$arrItem['kind']=$kind[0]['Name'];
			//---------------------------------------------------------
		
			 //require--------------------------------------
		 $require =$mdReq->getItemReq($item['ID']);
		  $listReq=array();
		  foreach ($require as $req)
		  {
		  	$nameReq=null;
		  		$nameReq= $mdKind->getTypeReq($req['TypeRequire']);
		  		$listReq[$nameReq[0]['Name']]=$req['Value'];
		  		
		  }
		  $arrItem['require']=$listReq;
		
		  //---------------------------------------------
		  
		  //unblock----------------------------------
		  $unblock =$mdUnblock->getItemUnblock($item['ID']);
		  $listUnblock=array();
		  foreach ($unblock as $unb)
		  {
		  	$nameUnblock=null;
		  		$nameUnblock= $mdKind->getTypeUnblock($unb['TypeUnblockID']);
		  		$listUnblock[$nameUnblock[0]['Name']]=$unb['Value'];
		  }
		   $arrItem['unblock']=$listUnblock;
		   //----------------------------------------------
		   
			$arr[$item['ID']]=$arrItem;
		}
		
		//-------------------------------------------------------------
		
		//shop---------------------------------------------------------
		$shops=$mdShop->getShopClient();
		foreach ($shops as $shop)
		{
			$arrShop=array();
			
			$listShop_item=$mdShopItem->getItemsID($shop['ID']);
			foreach ($listShop_item as $shop_item)
			{
				
				array_push($arrShop,$shop_item['ItemID']);
			
			}
			
			$arr[$shop['Name']]=$arrShop;
		}
		//-------------------------------------------------------------
		
		//ibshop-------------------------------------------------------
		$tabs_ibshop=$mdIbshop->getTabs();
		$arrIbshop=array();
		foreach ($tabs_ibshop as $tab)
		{
			$arrTab=array();
			
			$arrTab['tapIndex']=$tab['TabIndex'];
			$arrTab['resClass']=$tab['Resclass'];
			$arrTab['title']=$tab['Title'];
			$arrTab['data']=array();
			
			$listItem = $mdIbshop_item->Items($tab['ID']);
			foreach ($listItem as $item_ib)
			{
				array_push($arrTab['data'],$item_ib['ItemID']);
			}
			
			$arrIbshop[$tab['Name']]=$arrTab;
		}
		$arr['ib_shop']=$arrIbshop;
		//-------------------------------------------------------------
		
		$string = json_encode($arr);
		
		return $string;
	}
	
	public function ShopBuilding_conf_php() 
	{
		$mdShop = new Models_S_shop();
		$mdShopItem= new Models_S_shop_item();
		$mdItemshop = new Models_S_itemshop();
		$mdItem=new Models_S_item();
		$mdKind = new Models_S_Type_Get();
		$mdUnblock = new Models_S_unblock();
		$mdReq= new Models_S_require();
		
		
		$string = "
<?php
return ";
		$arr= array();
		$arr['CONFIG_DEFAULT_VALUE']= array
	(
		'type' => null,
		'buyPrice' => null,
		'requireLevel' => null,
		'pricePerLevel' => 1,
		'needCampaign' => false
	);
		
		
		//---vong lap xac dinh-------------------------------------
		
	$name='ShopBuilding';
		 $IDShop= $mdShop->getIDShop($name);		
		 $ListItemShopID= $mdShopItem->getItemsID($IDShop[0]['ID']);
		 // print_r($ListItemShopID);die();
		foreach ($ListItemShopID as $idto)
		 {
		 	$id=$idto['ItemID'];
		 $arr[$id]=null;
		 
		  $infoItemArr= $mdItemshop->getInfoItem($id);	
		 $infoItem=$infoItemArr[0];
		
		 //type------------------------------------------
		 if ($infoItem['Entity'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Entity']);  
		 if($infoItem['Item'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Item']); 
		 
		 	$arr[$id]['type']=$nameItem[0]['Name']; 
		 //---------------------------------------------
		 
		 //buyPrice--------------------------------------
		 $require =$mdReq->getItemReq($id);
		  $listReq=array();
		  foreach ($require as $req)
		  {
		  	$nameReq=null;
		  		$nameReq= $mdKind->getTypeReq($req['TypeRequire']);
		  		$listReq[$nameReq[0]['Name']]=$req['Value'];
		  		
		  }
		   $arr[$id]['buyPrice']=$listReq;
		
		  //---------------------------------------------
		  
		  //requireLevel----------------------------------
		  $unblock =$mdUnblock->getItemUnblock($id);
		  $listUnblock=array();
		  foreach ($unblock as $unb)
		  {
		  	$nameUnblock=null;
		  		$nameUnblock= $mdKind->getTypeUnblock($unb['TypeUnblockID']);
		  		$listUnblock[$nameUnblock[0]['Name']]=$unb['Value'];
		  }
		   $arr[$id]['requireLevel']=$listUnblock;
		   //----------------------------------------------
		   
		   //pricePerLevel---------------------------------
		   if($infoItem['pricePerLevel']!=null)
		   {
		    	$arr[$id]['pricePerLevel']=$infoItem['pricePerLevel'];
		   }
		    //--------------------------------------------
		    
		    //needCampaign--------------------------------
		    if($infoItem['NeedCamp']==1)
		    {		    	
		     		$arr[$id]['needCampaign']=true;
		    }
		     //----------------------------------------------
		 
		 }
		//----------------------------------------------------------
		
		 //--- + array to string-----------------------------------
		 $arrToStr = var_export($arr,true);
		 $string.=$arrToStr;
		 //---------------------------------------------------------
		 
		$string .= ";
?>
		";
		return $string;
	}
	
	public function ShopHero_conf_php() 
	{
		$mdShop = new Models_S_shop();
		$mdShopItem= new Models_S_shop_item();
		$mdItemshop = new Models_S_itemshop();
		$mdItem=new Models_S_item();
		$mdKind = new Models_S_Type_Get();
		$mdUnblock = new Models_S_unblock();
		$mdReq= new Models_S_require();
				
		
		$string = "
<?php
return ";
		$arr= array();
		$arr['CONFIG_DEFAULT_VALUE']= array
	(
		'type' => null,
		'level' => null,
		'buyPrice' => null,
		'incRates' => array(0.0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0),
		'requireLevel' => null,
		'pricePerLevel' => null,
		'needCampaign' => false
	);
		
		//---vong lap xac dinh-------------------------------------
		
	$name='ShopHero';
		 $IDShop= $mdShop->getIDShop($name);		
		 $ListItemShopID= $mdShopItem->getItemsID($IDShop[0]['ID']);
		 
		 foreach ($ListItemShopID as $idto)
		 {
		 	$id=$idto['ItemID'];
		 $arr[$id]=null;
		
		  $infoItemArr= $mdItemshop->getInfoItem($id);	
		 $infoItem=$infoItemArr[0];
		
		 //type------------------------------------------
		 if ($infoItem['Entity'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Entity']);  
		 if($infoItem['Item'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Item']); 
		 
		 	$arr[$id]['type']=$nameItem[0]['Name']; 
		 //---------------------------------------------
		 
		 	//level------------------------------------------
		 	if($infoItem['Level'] != null)
		 	 $arr[$id]['level']=$infoItem['Level'] ;
		 	//-----------------------------------------------
		 
		 //buyPrice--------------------------------------
		 	$require =$mdReq->getItemReq($id);
		 	 $listReq=array();
		  foreach ($require as $req)
		  {
		  	$nameReq=null;
		  		$nameReq= $mdKind->getTypeReq($req['TypeRequire']);
		  		$listReq[$nameReq[0]['Name']]=$req['Value'];
		  		
		  }
		   $arr[$id]['buyPrice']=$listReq;
		
		  //---------------------------------------------
		  
		  //requireLevel----------------------------------
		  $unblock =$mdUnblock->getItemUnblock($id);
		  $listUnblock=array();
		  foreach ($unblock as $unb)
		  {
		  	$nameUnblock=null;
		  		$nameUnblock= $mdKind->getTypeUnblock($unb['TypeUnblockID']);
		  		$listUnblock[$nameUnblock[0]['Name']]=$unb['Value'];
		  }
		   $arr[$id]['requireLevel']=$listUnblock;
		   //----------------------------------------------
		   
		   //pricePerLevel---------------------------------
		   if($infoItem['pricePerLevel']!=null)
		   {
		    	$arr[$id]['pricePerLevel']=$infoItem['pricePerLevel'];
		   }
		    //--------------------------------------------
		    
		    //needCampaign--------------------------------
		    if($infoItem['NeedCamp']==1)
		    {		    	
		     		$arr[$id]['needCampaign']=true;
		    }
		     //----------------------------------------------
		 
		 }
		//----------------------------------------------------------
		
		 //--- + array to string-----------------------------------
		 $arrToStr = var_export($arr,true);
		 $string.=$arrToStr;
		 //---------------------------------------------------------
		 
		$string.=";
?>
		";
		
		return $string;
	}
	
	public function ShopItem_conf_php() 
	{
		$mdShop = new Models_S_shop();
		$mdShopItem= new Models_S_shop_item();
		$mdItemshop = new Models_S_itemshop();
		$mdItem=new Models_S_item();
		$mdKind = new Models_S_Type_Get();
		$mdUnblock = new Models_S_unblock();
		$mdReq= new Models_S_require();
		
		$string = "
<?php
return ";
		$arr= array();
		$arr['CONFIG_DEFAULT_VALUE']= array
	(
		'type' => null,
		'buyPrice' => null,
		'requireLevel' => null,
		'pricePerLevel' => null,
		'needCampaign' => false
	);
			
		
		//---vong lap xac dinh-------------------------------------
		
	$name='ShopItem';
		  $IDShop= $mdShop->getIDShop($name);		
		 $ListItemShopID= $mdShopItem->getItemsID($IDShop[0]['ID']);
		 
		 foreach ($ListItemShopID as $idto)
		 {
		 	$id=$idto['ItemID'];
		 $arr[$id]=null;
		 
		  $infoItemArr= $mdItemshop->getInfoItem($id);	
		 $infoItem=$infoItemArr[0];
		
		 //type------------------------------------------
		 if ($infoItem['Entity'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Entity']);  
		 if($infoItem['Item'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Item']); 
		 
		 	$arr[$id]['type']=$nameItem[0]['Name']; 
		 //---------------------------------------------
		 
		 //buyPrice--------------------------------------
		 $require =$mdReq->getItemReq($id);
		  $listReq=array();
		  foreach ($require as $req)
		  {
		  	$nameReq=null;
		  		$nameReq= $mdKind->getTypeReq($req['TypeRequire']);
		  		$listReq[$nameReq[0]['Name']]=$req['Value'];
		  		
		  }
		   $arr[$id]['buyPrice']=$listReq;
		
		  //---------------------------------------------
		  
		  //requireLevel----------------------------------
		  $unblock =$mdUnblock->getItemUnblock($id);
		  $listUnblock=array();
		  foreach ($unblock as $unb)
		  {
		  	$nameUnblock=null;
		  		$nameUnblock= $mdKind->getTypeUnblock($unb['TypeUnblockID']);
		  		$listUnblock[$nameUnblock[0]['Name']]=$unb['Value'];
		  }
		   $arr[$id]['requireLevel']=$listUnblock;
		   //----------------------------------------------
		   
		   //pricePerLevel---------------------------------
		   if($infoItem['pricePerLevel']!=null)
		   {
		    	$arr[$id]['pricePerLevel']=$infoItem['pricePerLevel'];
		   }
		    //--------------------------------------------
		    
		    //needCampaign--------------------------------
		    if($infoItem['NeedCamp']==1)
		    {		    	
		     		$arr[$id]['needCampaign']=true;
		    }
		     //----------------------------------------------
		 
		 }
		//----------------------------------------------------------
		
		 //--- + array to string-----------------------------------
		 $arrToStr = var_export($arr,true);
		 $string.=$arrToStr;
		 //---------------------------------------------------------
		 
		
		
		$string.=";
?>
		";
		
		return $string;
	}
	
	public function ShopItemQuantity_conf_php() 
	{
		$mdShop = new Models_S_shop();
		$mdShopItem= new Models_S_shop_item();
		$mdItemshop = new Models_S_itemshop();
		$mdItem=new Models_S_item();
		$mdKind = new Models_S_Type_Get();
		$mdUnblock = new Models_S_unblock();
		$mdReq= new Models_S_require();
		
		
		$string = "
<?php
return ";
		$arr= array();
		$arr['CONFIG_DEFAULT_VALUE']= array
	(
		'type' => null,
		'buyPrice' => null,
		'requireLevel' => null,
		'pricePerLevel' => null,
		'needCampaign' => false
	);
				
		
		//---vong lap xac dinh-------------------------------------
		
	$name='ShopItemQuantity';
		 $IDShop= $mdShop->getIDShop($name);		
		 $ListItemShopID= $mdShopItem->getItemsID($IDShop[0]['ID']);
		 
		 foreach ($ListItemShopID as $idto)
		 {
		 	$id=$idto['ItemID'];
		 $arr[$id]=null;
		 
		  $infoItemArr= $mdItemshop->getInfoItem($id);	
		 $infoItem=$infoItemArr[0];
		
		 //type------------------------------------------
		 if ($infoItem['Entity'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Entity']);  
		 if($infoItem['Item'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Item']); 
		 
		 	$arr[$id]['type']=$nameItem[0]['Name']; 
		 //---------------------------------------------
		 
		 	///buyPrice--------------------------------------
		 $require =$mdReq->getItemReq($id);
		  $listReq=array();
		  foreach ($require as $req)
		  {
		  	$nameReq=null;
		  		$nameReq= $mdKind->getTypeReq($req['TypeRequire']);
		  		$listReq[$nameReq[0]['Name']]=$req['Value'];
		  		
		  }
		   $arr[$id]['buyPrice']=$listReq;
		
		  //---------------------------------------------
		  
		  //requireLevel----------------------------------
		  $unblock =$mdUnblock->getItemUnblock($id);
		  $listUnblock=array();
		  foreach ($unblock as $unb)
		  {
		  	$nameUnblock=null;
		  		$nameUnblock= $mdKind->getTypeUnblock($unb['TypeUnblockID']);
		  		$listUnblock[$nameUnblock[0]['Name']]=$unb['Value'];
		  }
		   $arr[$id]['requireLevel']=$listUnblock;
		   //----------------------------------------------
		   
		   //pricePerLevel---------------------------------
		   if($infoItem['pricePerLevel']!=null)
		   {
		    	$arr[$id]['pricePerLevel']=$infoItem['pricePerLevel'];
		   }
		    //--------------------------------------------
		    
		    //needCampaign--------------------------------
		    if($infoItem['NeedCamp']==1)
		    {		    	
		     		$arr[$id]['needCampaign']=true;
		    }
		     //----------------------------------------------
		 
		 }
		//----------------------------------------------------------
		
		 //--- + array to string-----------------------------------
		 $arrToStr = var_export($arr,true);
		 $string.=$arrToStr;
		 //---------------------------------------------------------
		 
		$string.=";
?>
		";
		
		return $string;
	}
	
	public function ShopSoldier_conf_php() 
	{
		$mdShop = new Models_S_shop();
		$mdShopItem= new Models_S_shop_item();
		$mdItemshop = new Models_S_itemshop();
		$mdItem=new Models_S_item();
		$mdKind = new Models_S_Type_Get();
		$mdUnblock = new Models_S_unblock();
		$mdReq= new Models_S_require();
		
		$string = "
<?php
return ";
		$arr= array();
		$arr['CONFIG_DEFAULT_VALUE']= array
	(
		'type' => null,
		'level' => null,
		'buyPrice' => null,
		'requireLevel' => null,
		'pricePerLevel' => null,
		'needCampaign' => false
	);
		
		
		
		//---vong lap xac dinh-------------------------------------
		
		$name='ShopSoldier';
		 $IDShop= $mdShop->getIDShop($name);		
		 $ListItemShopID= $mdShopItem->getItemsID($IDShop[0]['ID']);
		 
		 foreach ($ListItemShopID as $idto)
		 {
		 	$id=$idto['ItemID'];
		 $arr[$id]=null;
		 
		  $infoItemArr= $mdItemshop->getInfoItem($id);	
		 $infoItem=$infoItemArr[0];
		
		 //type------------------------------------------
		 if ($infoItem['Entity'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Entity']);  
		 if($infoItem['Item'] != null)
		 	$nameItem=$mdItem->getNameItem($infoItem['Item']); 
		 
		 	$arr[$id]['type']=$nameItem[0]['Name']; 
		 //---------------------------------------------
		 
		 	//-level------------------------------------
		 	if($infoItem['Level'] != null)
		 	 $arr[$id]['level']=$infoItem['Level'] ;
		 	//------------------------------------------
		 	
		 	//buyPrice--------------------------------------
		 $require =$mdReq->getItemReq($id);
		  $listReq=array();
		  foreach ($require as $req)
		  {
		  	$nameReq=null;
		  		$nameReq= $mdKind->getTypeReq($req['TypeRequire']);
		  		$listReq[$nameReq[0]['Name']]=$req['Value'];
		  		
		  }
		   $arr[$id]['buyPrice']=$listReq;
		
		  //---------------------------------------------
		  
		  //requireLevel----------------------------------
		  $unblock =$mdUnblock->getItemUnblock($id);
		  $listUnblock=array();
		  foreach ($unblock as $unb)
		  {
		  	$nameUnblock=null;
		  		$nameUnblock= $mdKind->getTypeUnblock($unb['TypeUnblockID']);
		  		$listUnblock[$nameUnblock[0]['Name']]=$unb['Value'];
		  }
		   $arr[$id]['requireLevel']=$listUnblock;
		   //----------------------------------------------
		   
		   //pricePerLevel---------------------------------
		   if($infoItem['pricePerLevel']!=null)
		   {
		    	$arr[$id]['pricePerLevel']=$infoItem['pricePerLevel'];
		   }
		    //--------------------------------------------
		    
		    //needCampaign--------------------------------
		    if($infoItem['NeedCamp']==1)
		    {		    	
		     		$arr[$id]['needCampaign']=true;
		    }
		     //----------------------------------------------
		 
		 }
		//----------------------------------------------------------
		
		 //--- + array to string-----------------------------------
		 $arrToStr = var_export($arr,true);
		 $string.=$arrToStr;
		 //---------------------------------------------------------
		 
		$string.=";
?>
		";
		
		return $string;
	}
	
	public function Version_conf_php() 
	{
		$mdVer= new Models_S_version();
		$ver=$mdVer->getVer();
		
		$string = "<?php
return ".$ver[0]['Version'].";

?>";
		
		return $string;
	}
	

}