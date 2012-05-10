<?php
class Zend_View_Helper_ListShop
{
	public function listShop($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";
		foreach($data as $key =>$row)
		{
			$arritem = "";
			
					$arritem .= $itemname->Name .";";
			$edit = "";
			$delete = "";
			$privilege = "";					
				$edit = "<a class='tool-16 edit' href='$view->baseUrl/shop/shop/shopmanager/id/$row->ID'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteItemShop($row->ID)'></a>";						
			$strList .= "<tr id='itemshop-$key'>							
							<td class='shop-id'>$row->Name</td>	
							<td class='shop-item'>$arritem</td>	
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
