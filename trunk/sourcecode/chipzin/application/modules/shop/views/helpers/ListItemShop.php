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
				$edit = "<a class='tool-16 edit' href='$view->baseUrl/shop/itemshop/edit/id/$row->I'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteItemShop($row->I)'></a>";;								
			$strList .= "<tr id=''>							
							<td class=''>$row->I</td>	
							<td class=''>$row->E</td>
							<td class=''>$row->Item</td>
							<td class=''>$row->K</td>
							<td class=''>$row->Icon</td>
							<td class=''>$row->Level</td>			
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
