<?php
class Zend_View_Helper_ListItemShop
{
public function listItemShop($data, $curPage, $itemPerPage ,$view)
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
				$edit = "<a class='tool-16 edit' href='javascript:editItemShop($key)'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteItemShop($key)'></a>";;								
			$strList .= "<tr id='itemshop-$key'>							
							<td class='id'>$row->ID</td>	
							<td class='entity-item'>$row->Entity</td>
							<td class='entity-item'>$row->Item</td>
							<td class='entity-item'>$row->Kind</td>
							<td class='entity-item'>$row->Icon</td>
							<td class='level'>$row->Level</td>			
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
