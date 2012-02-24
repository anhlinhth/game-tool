<?php
class Zend_View_Helper_ListQuest
{
	public function listQuest($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$md = new Models_Quest();
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";		
		foreach($data as $row)
		{
			if($row->enabled)
				$strActive = "<span style='color:green; font-weight:bold'>Kích hoạt</span>";
			else
				$strActive = "";
			
			$edit = "<a href='$view->baseUrl/quest/edit/id/$row->QuestID'><img src='$view->baseUrl/media/images/icons/edit-icon.gif' title='Chỉnh sửa' width='16' height='16' /></a>";
			$delete = "<a href='javascript:deleteItem(\"$view->baseUrl/quest/delete\",$row->QuestID)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";

		//	luu y
		//	$objSearch->gift_package_id = $row->id;
		//	$count = $md->_count($objSearch);
			
			if($count > 0)
				$src = "$view->baseUrl/media/images/icons/cartfull.png";
			else
				$src = "$view->baseUrl/media/images/icons/cart.png";
			
			$addContent = "<a href='$view->baseUrl/gift/item/id/$row->id'><img src='$src' title='Chỉnh sửa nội dung gói phần thưởng' width='16' height='16' /></a>";
						
			$strList .= "<tr>
							<td align='center'><input type='checkbox' name='chkid' onclick='checkOneItem(document.formPaging)' value='$row->QuestID' /></td>
							<td>$row->QuestID</td>
							<td>$row->QuestName</td>
							<td>$row->QuestLineID</td>
							<td align='center'>	
								$edit
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
