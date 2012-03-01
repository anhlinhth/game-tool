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
						echo("<SCRIPT LANGUAGE='JavaScript'>window.alert('Quest Id = $temp chưa có task')</SCRIPT>");
						return ;
					}
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