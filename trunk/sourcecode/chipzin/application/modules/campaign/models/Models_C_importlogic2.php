<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Award.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Battle.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Soldier.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Camp.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_BattleSold.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_Layout.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_AwardType.php';

require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_Battle.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_Battle_Soldier.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_Campaign.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'object' . DS . 'Obj_Award.php';

class Models_C_importlogic2 extends Models_Base {
	function battle($arr) {
		if ($arr != null) {
			$mdLayout = new Models_C_Layout (); 
			$mdAward = new Models_C_Award();
			$mdBaSo= new Models_C_BattleSold();
			$mdAwType= new Models_C_AwardType();
			$mdSo= new Models_C_Soldier();
			$mdBattle= new Models_C_Battle();
			
			$objAward = new Obj_Award();
			$objBaSo= new Obj_Battle_Soldier();
			$objBattle=new Obj_Battle();
			
			$layout=array();
			$dem=null;
			
			foreach ($arr as $k=>$val) 		//$k : battle id ; $val : thong tin
			{
				$layout=null;
				$dem=0;
				//-------------award--------------------------------------
				foreach ($val['awards'] as $k_aw => $val_aw)
				{
					$type_aw= strtolower($k_aw);
					$type_aw_id=null;
					
					if($type_aw=='honour')
					{
						$type_aw_id=$mdAwType->getIDType('exp');
					}
					else 
					{
					$type_aw_id=$mdAwType->getIDType($type_aw);
					}
					
					$objAward->BattleID=$k;
					$objAward->AwardTypeID=$type_aw_id;
					$objAward->Value=$val_aw;
					
					$mdAward->insert($objAward);
				}
				//--------------------------------------------------------
				
				
				//-----------------battle_soldier----------------------------
				foreach ($val['soldiers'] as $k_so => $val_so)
				{
					$objBaSo->BattleID=$k;
					$objBaSo->Level=$val_so[1];
					$objBaSo->Point=$k_so;
					$idso=$mdSo->getIDSoldier($val_so[0]);
					$objBaSo->Soldier=$idso[0]->ID;
					
					$mdBaSo->insert($objBaSo);
					
					
					$layout[$dem]=$k_so;
					
				$dem=$dem+1;
				}
				//-------------------------------------------------------------
			
				//-------update layout---------------------------------------
				$layout_all=$mdLayout->getAllLayout();
				
				
				foreach ($layout_all as $k_lo => $val_lo)
				{
					$kq=array_intersect($layout, $val_lo);
					if($layout==$kq)
					{
						
						$objBattle->ID=$k;
						$objBattle->Layout=$k_lo;
							//print_r($objBattle->ID);		
						$mdBattle->update($objBattle);
						
						break;
					}
				}
			}
			
		}
	}
	
	function map($arr) {
		if ($arr != null) {
			
			
			$mdBattle= new Models_C_Battle();
			$mdMap = new Models_C_Camp();
			
			$objBattle=new Obj_Battle();
			$objMap= new Obj_Campaign();
			
			$idMap=1;
			$idBarrack=1001;
			
			$idM_new=null;
			$idB_new=null;
			
			foreach ($arr as $k=>$val)
			{
				
				//-------------Map ( campaign )-----------
			if (strpos ( strtolower($k), 'map' ) !== FALSE)
			{
				$objMap->ID=$idMap;
				$objMap->Name=$k;
				
				$idM_new=$mdMap->insert($objMap);
				
			$idMap=$idMap+1;
			}
			else if (strpos ( strtolower($k), 'barrack' ) !== FALSE)
			{
				$objMap->ID=$idBarrack;
				$objMap->Name=$k;
				
				$idM_new=$mdMap->insert($objMap);
			$idBarrack=$idBarrack+1;
			}
			else return "Error";
			//-----------------------------------------------------------
			
			
			//-----------------Battle---------------------------------
			
			foreach ($val['openBattles'] as $order=>$bat)
			{
			$objBattle->ID=$bat;
			$objBattle->Campaign=$idM_new;
			$objBattle->Order=$order;
			
			$idB_new=$mdBattle->insert($objBattle);
			}
			
			}
			
			//--------------------------------------------------------
			
		}
	
	}

}