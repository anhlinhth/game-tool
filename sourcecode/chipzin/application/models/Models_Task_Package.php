<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';

class Models_Task_Package extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "q_task";		
	}	
	public function getGiftType()
	{
		$sql = "SELECT
					*
				FROM
					q_task";
		
		$data = $this->_db->fetchAll($sql);
		
		return $data;
	}
	
	public function generate($data)
	{
		$mdGiftPackageDetail = new Models_Task_Target_Package_Detail();
		$str .= "<?php\nreturn array\n(";
		if($data)
		{
			$i = 1;
			foreach($data as $row)
			{
				$str .= "\n" ;
				$str .= (int)$row['TaskID'] ;
				$str .= " => array(";				
				$str .= "\n\t'action' => ";
				$str .= "\n\tarray(";
				$str .="\n\t".(int)$row['ActionID']." => "."NULL".",\n\t),";
				$str .="\n\t"."'target' => ";
				$str .= "\n\tarray(";
				$objSearch->task_package_id = $row->id;
		
				$qneeds=$mdGiftPackageDetail->_filter($objSearch);
				if((int)$row['TargetType']!=NULL)
				{
					$str .="\n\t".(int)$row['TargetType']." => "." NULL,";
				}
				else
					if($qneeds)
						foreach($qneeds as $qneeds)
							if((int)$qneeds->TaskID==$row['TaskID'])
								$str .="\n\t".(int)$qneeds->TargetID." => "." NULL ,";
				$str .="\n\t"."),";
				$str .="\n\t 'quantity' => ".(int)$row['Quantity'].",";
				$str .="\n\t 'unlockCoin' => ".(int)$row['UnlockCoin'].",";
				$str .="\n"."),";
				$i++;
			}
		}
		
		$str .= "\n\n);\n?>";		
		
		$fp = fopen(TASK_PACKAGE_PHP_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		return true;
	}
}
?>