<?php
class Zend_View_Helper_ListRestore
{
	public function ListRestore($data, $curPage, $itemPerPage ,$view)
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
				$restore = "<a class='tool-24 reset ' href='javascript:restore($key)'></a>";				
				$delete = "<a class='tool-24 delete' href='javascript:deleteres($key)'></a>";;	
			$strList .= "<tr id='Type-$key' height=\"60\">
							<td class='ID' >$items</td>
							<td class='ID' id= 'Id-$key'>$row->ID</td>							
							<td class='datatime'>$row->DateTime</td>						
							<td align='center'>								
								$restore&nbsp								
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
