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
			foreach($data as $row)
			{
				$targetId = 'null';
				$objSearch->task_package_id = $row->id;
				$qneeds=$mdGiftPackageDetail->_filter($objSearch);
				if($qneeds)
				{
					foreach($qneeds as $qneeds)
					{
						if((int)$qneeds->TaskID==$row['TaskID'])
						{
							$targetId = $qneeds->TargetID;
							break;
						}
					}
				}
				
				$str .= "\n\t" ;
				$str .= $row['TaskID'];
				$str .= " => array\r\t(";				
				$str .= "\n\t\t'action' => ".$row['ActionID'] . ",";
				$str .= "\n\t\t'target' => ".$targetId.",";
				$str .= "\n\t\t'quantity' => ".$row['Quantity'].",";
				$str .= "\n\t\t'unlockCoin' => ".$row['UnlockCoin'];
				$str .= "\n\t),";
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