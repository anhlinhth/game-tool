<?php
class Zend_View_Helper_ListLog
{
	public function listLog($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		
		$strList .= "<tbody>";		
		foreach($data as $row)
		{			
			$strList .= "<tr>							
							<td align='center'>". date_format(date_create($row->action_date), "d-m-Y H:i:s") ."</td>
							<td>$row->user</td>
							<td>{$view->langData->_($row->action)}</td>	
							<td>$row->note</td>	
						</tr>";			
		}
		
		$strList .= "</tbody>";		
		
		echo $strList;
	}
}
?>
