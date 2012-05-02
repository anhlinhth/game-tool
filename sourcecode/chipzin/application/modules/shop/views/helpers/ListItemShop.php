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
				$delete = "<a class='tool-16 delete' href='javascript:deleteItemShop($row->I)'></a>";;								
			$strList .= "<tr id='itemshop-$key'>							
							<td class='shop-id'>$row->I</td>	
							<td class='shop-entity'>$row->E</td>
							<td class='shop-item'>$row->Item</td>
							<td class='shop-kind'>$row->K</td>
							<td class='shop-icon'>1212</td>
							<td class='shop-level'>$row->Level</td>			
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
