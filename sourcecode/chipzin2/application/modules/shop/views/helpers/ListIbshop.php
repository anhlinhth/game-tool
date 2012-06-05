<?php
class Zend_View_Helper_ListIbShop
{
public function listIbShop($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";
		foreach($data as $key =>$row)
		{			
			$arritem = "";				
			foreach ($row->arrItem as $itemname)						
				$arritem .= $itemname->itemname .";";							
			$edit = "";
			$delete = "";
			$privilege = "";					
				$edit = "<a class='tool-16 edit' href='$view->baseUrl/shop/ibshop/edit/id/$row->ID'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteIbShop($row->ID)'></a>";;								
			$strList .= "<tr >													
							<td >$row->Name</td>								
							<td >$arritem</td>																						
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
