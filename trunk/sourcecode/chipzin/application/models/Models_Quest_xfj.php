<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';

class Models_Quest_xfj extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "q_quest";		
	}	
	public function getGiftType()
	{
		$sql = "SELECT
					*
				FROM
					q_quest";
		
		$data = $this->_db->fetchAll($sql);
		
		return $data;
	}
	
	public function generate($data)
	{
		$str .= "{";
		$mdGiftPackageDetail = new Models_Quest_Package_Detail();
		if($data)
		{
			$i = 1;
			$mdGiftPackageDetail = new Models_Quest_Package_Detail();
			$qtc = new Models_QTC();
			$str .= "\n" ;
				$str .= " \t\"quests\"  :";				
				$str .= "\n\t{";
			foreach($data as $row)
			{
				
				$str .= "\n\t\t\"".(int)$row['QuestID']."\":";
				$temp=(int)$row['QuestLineID'];
				$str .= "\n\t\t{";
				$str .= "\n\t\t\t \"group\" : ".(int)$row['QuestLineID'];
				if($row['NextQuest']!=NULL)
					$str .= "\n\t\t\t \"nextQuest\" : [\"".(int)$row['NextQuest']."\"]";
				else
					$str .= "\n\t\t\t \"nextQuest\" : NULL";
					
				$str .= "\n\t\t\t \"tasks\" : [";
				$objSearch->task_package_id = $row->id;
				$gifts=$mdGiftPackageDetail->_filter($objSearch);
				if($gifts)
				{
					$j=0;
					foreach($gifts as $gift)
					{
							if($temp==$gift->QuestID)
							{
								$j++;
								if($j==2)
								{
									$str .=",";
									$j=1;
								}
								$str .="\"".(int)$gift->TaskID."\"";	
							}
														
					}
				}
				$str .= "]";
				$str .= ",\n\t\t\t \"txtName\" : \"".trim($row['QuestGroupString'])."\",";
				$str .= "\n\t\t\t \"txtAlias\" : \"".trim($row['QuestString'])."\",";
				$str .= "\n\t\t\t \"txtDesc\" : \"".trim($row['QuestDescString'])."\",";
				$str .= "\n\t\t\t \"award\" :";
				$str .= "\n\t\t\t { ";
				$str .= "\n\t\t\t\t \"gold\" : ".$row['AwardGold'].",";
				$str .= "\n\t\t\t\t \"exp\" : ".$row['AwardExp'];
				$str .= "\n\t\t\t } ";
				$i++;
				$str .= "\n\t }, \n";
			}
		}
		$md = new Models_Task_Target_Package_Detail();
		$am = new Models_QTC();
		if($gifts)
		{	
			$i=0;
			$str .= "\n" ;
				$str .= " \t\"quest_tasks\"  :";				
				$str .= "\n\t{";
				foreach($gifts as $gifts)
				{
					$str .= "\n\t\t\"".(int)$gifts->TaskID."\" :";
					$str .= "\n\t\t{";
					$str .= "\n\t\t\t \"questId\" : ".(int)$gifts->QuestID.",";
					$str .= "\n\t\t\t \"payFinish\" : ".(int)$gifts->UnlockCoin.",";
					$str .= "\n\t\t\t \"quantity\" : ".(int)$gifts->Quantity.",";
					$objSearch->task_package_id = $gifts->id;
					$sf=$am->_filter($objSearch);
					if($sf)
					{
						foreach ($sf as $sf)
						{
							if((int)$gifts->QTC_ID==(int)$sf->QTC_ID)
								$str .= "\n\t\t\t \"taskType\" : \"".$sf->QTC_Name."\",";
						}
					}
					else 
						$str .= "\n\t\t\t \"taskType\" : NULL,";
					$objSearch->task_package_id = $gifts->id;
					$sf=$md->_filter($objSearch);
					
					$file2= ROOT_IMPORT_FILE.'/system.xfj';
					$fileContent = file_get_contents ($file2);
					$arr=json_decode($fileContent);
					
					if($gifts->TargetType!=NULL)
					{
						foreach ($arr->entity as $key => $value)
						{
							if($key== $gifts->TargetType)
							{
								
								$str .= "\n\t\t\t \"gameType\" : [\"".$value->gameType."\"],";
							}
						}
						
					}
						else 
					{
						$a=0;
						if($sf)
						{
							foreach ($sf as $sf)
							{
						
								if((int)$sf->TaskID==(int)$gifts->TaskID&&$a==0)
								{
									$str .="\n\t\t\t \"entityType\" : ["."\"".(int)$sf->TargetID."\"";
									$a++;
									continue;
								}
								if((int)$sf->TaskID==(int)$gifts->TaskID&&$a==1)
								{
									$str .=",\"".(int)$sf->TargetID."\"";
								}
							}
							if($a!=0)
							$str .= "],";
						}
						if($a==0)
							$str .= "\n\t\t\t \"gameType\" : "."NULL".",";
					}
					$str .= "\n\t\t\t \"txtContent\" : \"".trim($gifts->TaskString)."\",";
					$str .= "\n\t\t\t \"txtHelp\" : \"".trim($gifts->HelpString)."\",";
					$str .= "\n\t\t\t \"iconClassName\" : \"".trim($gifts->IconClassName)."\",";
					$str .= "\n\t\t},\n";
					$i++;
				}
				$str .= "\n\t}";
		}
		$str .= "\n}";		
		
		$fp = fopen(QUEST_PACKAGE_XFJ_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		return true;
	}
}
?>