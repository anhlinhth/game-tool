<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';

class Models_Quest_Package extends Models_Base
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
		$error = array();
		$str .= "<?php\nreturn array\n(";
		$mdGiftPackageDetail = new Models_Quest_Package_Detail();
		$mdQuestLine = new Models_Quest_Line();
		if($data)
		{
			$i = 1;
			foreach($data as $row)
			{
				$str .= "\n" ;
				$str .= (int)$row['QuestID'] ;
				$str .= " => array(";				
				$str .= "\n\t'group'=> ";
				
				$lineIcon = $mdQuestLine-> search($row['QuestLineID']);
				$str .= trim($lineIcon).",";
				
				//$str .= (int)$row['QuestLineID'].",";
				if($row['NeedQuest']!=NULL)
					$str .= "\n\t'needQuest' =>".$row['NeedQuest'].",";
				else 
					$str .= "\n\t'needQuest' => NULL,";
				$temp= (int)$row['QuestID'];
				$objSearch->quest_package_id = $row->id;		
		
				/*
				if($qneeds)
				{
					foreach($qneeds as $qneeds)
					{
						if($temp==$qneeds->QuestID)
							$str .= "\n\t array( 0 => ".(int)$qneeds->NeedQuest;
						else 
							$str .= " NULL,";
					}
					if($temp==$qneeds->QuestID)
					$str .= "\n\t ),";
				}
				else 
					$str .= " NULL,";
				*/
				$str .= "\n\t'tasks' => ";
				
				$objSearch->quest_package_id = $row->id;
				$gifts = $mdGiftPackageDetail->_filter($objSearch);				
				if($gifts)
				{
					$j=0;
					$true1=0;
					$str .= "\n\tarray(";
					foreach($gifts as $gift)
					{
							if($temp==$gift->QuestID)
							{
								$true1=1;
								$str .= "\n\t $j => ".$gift->TaskID." ,";
								$j++;
							}
					}
					if($true1==1)
						$str .= "\n\t),";
					else 
					{				
						$error[] = $temp ;						
					}
				}
				$str .= "\n\t'award' => ";
				$str .= "\n  array(";	
				if((int)$row['AwardExp']!=0)
				{
					$str .= "\n\tHONOUR=> ";
				
					$str .= (int)$row['AwardExp'].",";
				}
					if((int)$row['AwardGold']!=0)
					{
						$str .= "\n\tGOLD=> ";
				
						$str .= (int)$row['AwardGold'];
					}
				$str .= "\n\t\t\t),";				
				$str .= "\n),";
				$i++;
			}
		}
		
		$str .= "\n\n);\n?>";
		if(empty($error)){
			$fp = fopen(QUEST_PACKAGE_PHP_FILE, 'w');
			if(fwrite($fp, $str) === false)
			{
				fclose($fp);				
			}
		}else{
			return $error;
		}		
		
		
	}
}
?>