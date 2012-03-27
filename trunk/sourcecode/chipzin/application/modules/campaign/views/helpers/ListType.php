<?php
class Zend_View_Helper_ListType
{
	public function ListType($data, $curPage, $itemPerPage ,$view)
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
				$edit = "<a class='tool-16 edit' href='javascript:editType($key)'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteType($key)'></a>";;								
			$strList .= "<tr id='Type-$key'>							
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
