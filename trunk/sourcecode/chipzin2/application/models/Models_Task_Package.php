<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
// require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
// require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';

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
	public function getGiftType1($id)
	{
		$sql = "SELECT
					TargetID
				FROM
					q_task_target WHERE TaskID=$id";
		
		$data = $this->_db->fetchONE($sql);
		
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
				$str .=(int)$row['ActionID'].",";
				$str .="\n\t"."'target' => ";
				$objSearch->task_package_id = $row->id;
		
				$qneeds= $this->getGiftType1($row['TaskID']);
				if((int)$row['TargetType']!=NULL)
				{
					$str .=(int)$row['TargetType'].",";
				}
				else
					if($qneeds){
						$str .=$qneeds.",";
					}else
						$str .="null,";
				$str .="\n\t 'quantity' => ".(int)$row['Quantity'].",";
				if($row['UnlockCoin']!=0)
				$str .="\n\t 'unlockCoin' => ".(int)$row['UnlockCoin'].",";
				else 
					$str .="\n\t 'unlockCoin' => NULL,";
				if($row['Counter']==0)
					$str .="\n\t 'counter' => false,";
				else 
					$str .="\n\t 'counter' => true,";
				if($row['Area']==null || $row['Area']==0 )
					$str .="\n\t 'area' => null,";
				else 
					$str .="\n\t 'area' => ".(int)$row['Area'].",";
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