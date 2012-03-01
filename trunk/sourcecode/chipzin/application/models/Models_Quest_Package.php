<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';

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
		$str .= "<?php\nreturn array\n(";
		$mdGiftPackageDetail = new Models_Quest_Package_Detail();
		$mdQneedPackageDetail = new Models_Qneeds_Package_Detail();
		if($data)
		{
			$i = 1;
			foreach($data as $row)
			{
				$str .= "\n" ;
				$str .= (int)$i ;
				$str .= " => array(";				
				$str .= "\n\t'group'=> ";
				$str .= (int)$row['QuestID'].",";
				$str .= "\n\t'needQuest' =>";
				$temp= (int)$row['QuestID'];
				$objSearch->quest_package_id = $row->id;
		
				$qneeds=$mdQneedPackageDetail->_filter($objSearch);
				
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
				
				$str .= "\n\t'tasks' => ";
				
				$objSearch->quest_package_id = $row->id;
				$gifts = $mdGiftPackageDetail->_filter($objSearch);
				
				if($gifts)
				{
					$j=0;
					$str .= "\n\tarray(";
					foreach($gifts as $gift)
					{
							if($temp==$gift->QuestID)
							{
								$str .= "\n\t $j => ".$gift->TaskID." ,";
								$j++;
							}
					}
					$str .= "\n\t),";
				}
				$str .= "\n\t'award' => ";
				$str .= "\n  array(";	
				$str .= "\n\t'Honour'=> ";
				$str .= (int)$row['AwardExp'];
				$str .= "\n\t'Gold'=> ";
				$str .= (int)$row['AwardGold'];
				$str .= "\n\t\t\t),";
				
				$str .= "\n),";
				$i++;
			}
		}
		
		$str .= "\n\n);\n?>";		
		
		$fp = fopen(QUEST_PACKAGE_PHP_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		return true;
	}
}
?>