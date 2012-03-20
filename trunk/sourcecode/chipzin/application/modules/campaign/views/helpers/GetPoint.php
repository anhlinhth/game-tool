<?php
class Zend_View_Helper_GetPoint
{
	public function GetPoint($data,$point)
	{
		$arrData=array();
		foreach ($data as $row)
		{
			if($row->Point==$point)
			{
				$arrData['Solider']=$row->Soldier;
				$arrData['Level']=$row->Level;
				return $arrData;
			}	
					
		}
		return 'default';	
	}
}
?>
