<?php
class Zend_View_Helper_ListEvent
{
	public function listEvent($data,$view)
	{
		if(!$data)
			return;
		$i = 1;
		
		foreach($data as $row)
		{
			$beginTime	= date("m/d/Y H:i:s",$row->min);
			$endTime	= date("m/d/Y H:i:s",$row->max);
			
			$selectedGold	= "";
			$selectedExp	= "";			
			
			$strList .= "<fieldset id='event$i'>
							<legend>Sự kiện &nbsp;&nbsp;<a title='Xóa' href='javascript:deleteEventReal($row->id,$i)'><img src='$view->baseUrl/media/images/icons/delete.gif'/></a></legend>
								<input name='hidId[]' value='$row->id' type='hidden' />
								<label for='begin'>Bắt đầu : </label>
								<input name='txtBeginTime[]' value='$beginTime' id='txtBeginTime_$i' type='text' tabindex='1' />&nbsp;(mm/dd/yyyy)
								<br />
								<label for='end'>Kết thúc : </label>
								<input name='txtEndTime[]' value='$endTime' id='txtEndTime_$i' type='text' tabindex='1' />&nbsp;(mm/dd/yyyy)
								<br />
								<label for='gold'>Vàng : x</label>
								<input name='txtGold[]' value='$row->gold' id='txtGold_$i' type='text' tabindex='1' />&nbsp;
								<br /> 	
								<label for='value'>Kinh nghiệm : x</label>
								<input name='txtExp[]' value='{$row->exp}' id='txtExp$i' type='text' tabindex='6' />
							</fieldset>";
			
			$i++;
		}
		
		echo $strList;
	}
}
?>


