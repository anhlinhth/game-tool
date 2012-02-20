<?php
class Zend_View_Helper_ListItem
{
	public function listItem($data, $curPage, $itemPerPage ,$view)
	{
		$arrData = array(
			array("id" => ITEM_TYPE_THUCPHAM, "name" => "Thực phẩm"),
			array("id" => ITEM_TYPE_NGOAICANH, "name" => "Ngoại cảnh"),
			array("id" => ITEM_TYPE_VATPHAMBOTRO, "name" => "Vật phẩm bổ trợ"),
			array("id" => ITEM_TYPE_NGOAITRANG, "name" => "Ngoại trang"),			
			array("id" => ITEM_TYPE_TINHLUYEN, "name" => "Vật phẩm tinh luyện"),
			array("id" => ITEM_TYPE_TRUNGTHU, "name" => "Vật phẩm trung thu (Sự kiện)"),
			array("id" => ITEM_TYPE_KIMINLENH, "name" => "Kim ỉn lệnh (Sự kiện)"),
			array("id" => ITEM_TYPE_TRIAN, "name" => "Vật phẩm tri ân (Sự kiện)"),
			array("id" => ITEM_TYPE_GIFT, "name" => "Gói phần thưởng, giảm giá")			
		);
		
		if(!$data)
			return;				
		$strList .= "<tbody>";		
		foreach($data as $row)
		{			
			$edit = "<a href='$view->baseUrl/shopeditor/edititem/id/$row->id'><img src='$view->baseUrl/media/images/icons/edit-icon.gif' title='Chỉnh sửa' width='16' height='16' /></a>";
			$delete = "<a href='javascript:deleteItem(\"$view->baseUrl/shopeditor/deleteitem\",$row->id)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";
								
			if($row->type == ITEM_TYPE_GIFT)
				$image = "$view->baseUrl/media/images/item/itemgift/$row->image";
			else
				$image = "$view->baseUrl/media/images/item/$row->image";
			
			if($row->enableInShop)
				$strStatus = "<span style='color:green; font-weight:bold'>Có</span>";
			else
				$strStatus = "<span style='color:black; font-weight:bold'>Không</span>";
			
			$strList .= "<tr>
							<td align='center'><input type='checkbox' name='chkid' onclick='checkOneItem(document.formPaging)' value='$row->id' /></td>							
							<td>$row->id</td>
							<td>$row->name</td>
							<td align='center'><img src='$image'/></td>
							<td align='center'>". $arrData[$row->type]['name'] ."</td>
							<td align='center'>$strStatus</td>
							<td align='center'>	
								$edit								
								&nbsp;$delete
							</td>
						</tr>";			
		}
		
		$strList .= "</tbody>";		
		
		echo $strList;
	}
}
?>
