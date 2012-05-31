<?php
class Zend_View_Helper_ListAwardType
{
	public function ListAwardType($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";
		foreach($data as $key =>$row)
		{					
			$edit = "";
			$delete = "";
			$privilege = "";					
				$edit = "<a class='tool-16 edit' href='javascript:editAdwardType($key)'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteType($key)'></a>";;								
			$strList .= "<tr id='AdwardType-$key'>							
							<td class='id'>$row->AdwardTypeID</td>	
							<td class='name'>$row->Name</td>						
							<td align='center'>								
								$edit&nbsp								
								$delete								
							</td>
						</tr>";
			$items++;
		}
		
		$strList .= "</tbody>";		
		
		echo $strList;
	}
}
?>
