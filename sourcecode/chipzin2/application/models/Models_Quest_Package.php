<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
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
	public function getAward($id)
	{
		$sql = "SELECT
					*
				FROM
					q_award
				WHERE
				QuestID='$id'";
		
		$data = $this->_db->fetchAll($sql);
		return $data;
	}
	public function getawardtype($id)
	{
			$sql = "SELECT
					Name
				FROM
					q_award_type
				WHERE
				AwardTypeID='$id'";
		
		$data = $this->_db->fetchOne($sql);
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
				$str .= "\n\t" ;
				$str .= (int)$row['QuestID'] ;
				$str .= " => array\n\t(";				
				$str .= "\n\t\t'group' => ";
				
				$lineIcon = $mdQuestLine-> search($row['QuestLineID']);
				$str .= trim($lineIcon).",";
				
				//$str .= (int)$row['QuestLineID'].",";
				if($row['NeedQuest']!=NULL)
					$str .= "\n\t\t'needQuest' => ".$row['NeedQuest'].",";
				else 
					$str .= "\n\t\t'needQuest' => null,";
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
				$str .= "\n\t\t'tasks' => array";
				
				$objSearch->quest_package_id = $row->id;
				$gifts = $mdGiftPackageDetail->_filter($objSearch);				
				if($gifts)
				{
					$j=0;
					$true1=0;
					$str .= "\n\t\t(";
					foreach($gifts as $gift)
					{
							if($temp==$gift->QuestID)
							{
								$true1=1;
								$str .= "\n\t\t\t $j => ".$gift->TaskID.",";
								$j++;
							}
					}
					if($true1==1)
						$str .= "\n\t\t),";
					else 
					{				
						$error[] = $temp ;						
					}
				}
				
				$mda = $this->getAward($row['QuestID']);
				if(!empty($mda)){
				$str .= "\n\t\t'award' => array";	
				$str .= "\n\t\t(\n";	
				
				
				foreach ($mda as $row2)
				{
					if(trim(strtoupper($this->getawardtype($row2['AwardTypeID']))=="EXP"))
						$str .="\t\t\t"."HONOUR"." => ".$row2['Value'].", \n";
					else
						$str .="\t\t\t".strtoupper(trim($this->getawardtype($row2['AwardTypeID'])))." => ".$row2['Value'].", \n";
				}
				$str .= "\t\t),";		
				}
				else 
					$str .= "\n\t\t'award' => NULL";
						
				$str .= "\n\t),";
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