<?php
class Zend_View_Helper_ListNotice
{
	public function listNotice($data, $view)
	{
		if(!$data)
			return;
		$i = 1;
        $strFormat = 'Y-m-d H:i';
		foreach($data as $row)
		{
            $content = $row['data'];
            $start = date($strFormat, $row['start']);
            $end = date($strFormat, $row['end']);
            $start = explode(' ', $start);
            $end = explode(' ', $end);
            $startDate = $start[0];
            $startTime = $start[1];
            $endDate = $end[0];
            $endTime = $end[1];
            
			$strList .= "<fieldset id='notice$i'>
							<legend>Thông báo &nbsp;&nbsp;<a title='Xóa' href='javascript:deleteNotice($i)'><img src='$view->baseUrl/media/images/icons/delete.gif'/></a></legend>
								<label for='street'>Nội dung : </label>
								<textarea onblur='generateLink($i)' style='margin-bottom: 5px' cols='70' rows='3' name='txtContent$i' id='txtContent$i' tabindex='1'></textarea>
								<br />
								<label for='city'>Username : </label>
								<input onblur='generateLink($i)' name='txtUserName$i' id='txtUserName$i' type='text' tabindex='2' />
								<br />
								<label for='country'>Link : </label>
								<textarea readonly style='margin-bottom: 5px' cols='70' rows='3' name='txtNotice[]' id='txtNotice$i' tabindex='3'>$content</textarea>
                                <br/>
                                <label>Start date:</label>
                                <input name='txtStart[]' id='txtStart$i'' type='text' tabindex='4' value='$startDate'/>
                                Time <input name='txtStartTime[]' id='txtStartTime$i' type='text' tabindex='5' maxlength='5' size='5' value='$startTime'/>
                                <br/>
                                <label>End date:</label>
                                <input name='txtEnd[]' id='txtEnd$i' type='text' tabindex='6' value='$endDate'/>
                                Time <input name='txtEndTime[]' id='txtEndTime$i' type='text' tabindex='7' maxlength='5' size='5' value='$endTime'/>
							</fieldset>";
			
			$i++;
		}
		
		echo $strList;		
	}
}