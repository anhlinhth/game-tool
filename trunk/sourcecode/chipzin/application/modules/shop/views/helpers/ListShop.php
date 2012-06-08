<?php
class Zend_View_Helper_ListShop
{
	public function listShop($data,$datatype, $curPage, $itemPerPage ,$view)
	{
		$select="";
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";
		foreach($data as $key =>$row)
		{
			$arritem = "";
			foreach ($row->arrItem as $itemname)	
					$arritem .= $itemname->Name .";";
			$edit = "";
			$delete = "";
			$privilege = "";					
				$edit = "<a class='tool-16 edit' href='$view->baseUrl/shop/shop/shopmanager/id/$row->ID'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteItemShop($row->ID)'></a>";						
			$strList .= "<tr id='itemshop-$key'>
							<td class='shop-id'>$row->ID</td>							
							<td class='shop-name'>$row->Name</td>
							<td class='shop-type-name'>
								<select name='typeshop_$row->ID' id='typeshop_$row->ID' onchange='changetypeshop($row->ID)'>
								";
			foreach ($datatype as $rowtype){
				if($rowtype->ID == $row->typeIDshop)
					$select="selected";
				else 
					$select="";
				$strList.="<option $select value='$rowtype->ID'>$rowtype->Name</option>";
			}
					$strList.="</select></td>	
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
