<?php
class Zend_View_Helper_ListWorldmap
{
	public function ListWorldmap($data, $curPage, $itemPerPage ,$view)
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
				$edit = "<a class='tool-16 edit' href='javascript:editWorldmap($key)'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteWorldmap($key)'></a>";;								
			$strList .= "<tr id='Worldmap-$key'>							
							<td class='id'>$row->ID</td>	
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
