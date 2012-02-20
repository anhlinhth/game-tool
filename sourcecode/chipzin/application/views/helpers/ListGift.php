<?php
class Zend_View_Helper_ListGift
{
	public function listGift($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$md = new Models_Gift_Package_Detail();
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";		
		foreach($data as $row)
		{
			if($row->enabled)
				$strActive = "<span style='color:green; font-weight:bold'>Kích hoạt</span>";
			else
				$strActive = "";
			
			$edit = "<a href='$view->baseUrl/gift/edit/id/$row->id'><img src='$view->baseUrl/media/images/icons/edit-icon.gif' title='Chỉnh sửa' width='16' height='16' /></a>";
			$delete = "<a href='javascript:deleteItem(\"$view->baseUrl/gift/delete\",$row->id)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";
			
			$objSearch->gift_package_id = $row->id;
			$count = $md->_count($objSearch);
			
			if($count > 0)
				$src = "$view->baseUrl/media/images/icons/cartfull.png";
			else
				$src = "$view->baseUrl/media/images/icons/cart.png";
			
			$addContent = "<a href='$view->baseUrl/gift/item/id/$row->id'><img src='$src' title='Chỉnh sửa nội dung gói phần thưởng' width='16' height='16' /></a>";
						
			$strList .= "<tr>
							<td align='center'><input type='checkbox' name='chkid' onclick='checkOneItem(document.formPaging)' value='$row->id' /></td>
							<td align='center'>$items</td>
							<td>$row->alias</td>
							<td>$row->name</td>
							<td>$row->description</td>
							<td align='center'>$strActive</td>
							<td align='center'>	
								$edit
								&nbsp;$addContent
								&nbsp;$delete
							</td>
						</tr>";
			$items++;
		}
		
		$strList .= "</tbody>";		
		
		echo $strList;
	}
}
?>
