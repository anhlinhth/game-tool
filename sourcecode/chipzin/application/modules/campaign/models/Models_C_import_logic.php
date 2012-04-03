<?php
//require_once ROOT_APPLICATION.DS .'modules'.DS.'campaign'.DS.'models'.DS.'Models_C_Award.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Battle.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_NextCamp.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_World.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Camp.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_BattleSold.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Layout.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_Soldier.php';

require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_Battle.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_Battle_Soldier.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_Campaign.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_WorldMap.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_Soldier.php';


class Models_C_import_logic {
	
	/*
	["aa"]=> { 
			["L�ng 5"]=> { 
				["Type"]=> "VILLAGE" ,
				["Battle"]=> { 
								["Trận 1"]=>{ 
											["layout"]=> "Mũi tên",
											["vt1"]=> int(116),
											 ["vt2"]=> string(0) "",
											  ["vt3"]=> int(6),
											   ["vt4"]=> string(0) "",
											    ["vt5"]=> string(0) "" } 
								["Trận 2"]=> { 
												["layout"]=> string(7) "Chữ X",
												 ["vt1"]=> int(118),
												  ["vt2"]=> string(0) "" ,
												  ["vt3"]=> int(6) ,
												  ["vt4"]=> string(0) "" ,
												  ["vt5"]=> string(0) "" } 
								["Trận 3"]=>{ 
											["layout"]=> string(7) "Chữ X" ,
											["vt1"]=> int(120) ,
											["vt2"]=> string(0) "" ,
											["vt3"]=> int(6) ,
											["vt4"]=> string(0) "" ,
											["vt5"]=> string(0) "" } ,
								["Trận 4"]=> { 
											["layout"]=> string(9) "Mũi tên" ,
											["vt1"]=> int(122) ,
											["vt2"]=> string(0) "" ,
											["vt3"]=> int(6) ,
											["vt4"]=> string(0) "" ,
											["vt5"]=> string(0) "" } 
							} 
					}
			} 
	 * */
	
	public function logicCamp($arr) {
		
		// khoi tao models + obj
		$mdBattle = new Models_C_Battle ();
		$mdNext = new Models_C_NextCamp ();
		$mdWorld = new Models_C_World ();
		$mdCamp = new Models_C_Camp ();
		$mdBSoldier = new Models_C_BattleSold ();
		
		$objWorld=new Obj_WorldMap();
		$objCamp=new Obj_Campaign();
		$objBattle =new Obj_Battle();
		$objBSo= new Obj_Battle_Soldier();
		//---------------------------------------------------------
		
		
		//cac bien
		$worldID=null;  		//luu world map id
		$campID=null;			//luu campaign id
		$oldCampID=null;		//luu id cua campaign truoc do vua them
		$battleID=null;			//luu id cua battle
		$order=1;			//luu so thu tu cua battle
		//-----------------------------------------------------------
		
		//var_dump($arr);
		//die();
		// tang tren cung : world map
		foreach ( $arr as $key => $value ) {
			
			$objWorld->Name=$key;
			$worldID=$mdWorld->insert ( $objWorld );
			//$mdCamp->deleteAll ( $worldID );
			
			//tang thu 2 : camp
			foreach ( $value as $ca => $vlca ) {
				
				$mdCamp->deleteSome($worldID, $ca);
				
				$objCamp->Name=$ca;
				$objCamp->WorldMap=$worldID;
				$objCamp->NeedCamp=$oldCampID;				
				$campID=$mdCamp->insert($objCamp, $vlca['Type']);
				
				
				//tang thu 3 : battle
				foreach ( $vlca['Battle'] as $bt => $vlbt ) {

					$objBattle->Order=$order;
					$objBattle->Campaign=$campID;
					
					$battleID=$mdBattle->insert($objBattle, $vlbt['layout']);
					$point=$this->getPoint($vlbt['layout']);
					
					//tang thu 4 : battle-soldier
				
						
						if(!empty($vlbt['vt1']))
						{
						$objBSo->BattleID=$battleID;
						$objBSo->Level=$vlbt['vt1'];
						$objBSo->Point=$point[0];
				
						$mdBSoldier->insert($objBSo);
						}
						
					if(!empty($vlbt['vt2']))
						{
						$objBSo->BattleID=$battleID;
						$objBSo->Level=$vlbt['vt2'];
						$objBSo->Point=$point[1];
				
						$mdBSoldier->insert($objBSo);
						}
						
					if(!empty($vlbt['vt3']))
						{
						$objBSo->BattleID=$battleID;
						$objBSo->Level=$vlbt['vt3'];
						$objBSo->Point=$point[2];
				
						$mdBSoldier->insert($objBSo);
						}
						
					if(!empty($vlbt['vt4']))
						{
						$objBSo->BattleID=$battleID;
						$objBSo->Level=$vlbt['vt4'];
						$objBSo->Point=$point[3];
				
						$mdBSoldier->insert($objBSo);
						}
						
					if(!empty($vlbt['vt5']))
						{
						$objBSo->BattleID=$battleID;
						$objBSo->Level=$vlbt['vt5'];
						$objBSo->Point=$point[4];
				
						$mdBSoldier->insert($objBSo);
						
						
						}
			
					
					
					$order=$order+1;
			
				}
			
				if($oldCampID!=null)
				$mdNext->insert($oldCampID,$campID);
				$oldCampID=$campID;
				$order=1;
			}
		}
		
		return 1;
	
	}
	
	
	
	public function getPoint($name) {
		
		$mdlayout = new Models_C_Layout ();
		$layout = array ();
		$layout = $mdlayout->getLayout ( $name );
		$strPoint = $layout [0]->Point;
		$strPoint = substr ( $strPoint, 1, strlen ( $strPoint ) - 2 );
		$arrPoint = explode ( ',', $strPoint );
		$dem = 0;
		$arrP = array ();
		foreach ( $arrPoint as $key => $value ) {
			if ($value == 1) {
				$arrP [$dem] = $key;
				$dem = $dem + 1;
			}
		}
		//-> vt1 - $arr[0] , vt2 - $arr[1] , vt3 - $arr[2] , vt4 - $arr[3] , vt5 - $arr[4]
		

		return $arrP;
	}

	
	public function logicSoldier($arr)
	{
	$mdSo = new Models_Soldier();
	$objSo= new Obj_Soldier();
	foreach ($arr as $key => $value)
	{
		$objSo->ID=$key;
		$objSo->Name=$value;
		
		$bool=$mdSo->isExistSoldier($key);
		
	if ($bool){
	$mdSo->update($objSo);
	}
	else {
	 $mdSo->insert($objSo);
	}
	}
	return 1;
	}
	
}
