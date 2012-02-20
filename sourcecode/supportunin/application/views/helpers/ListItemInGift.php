<?php
class Zend_View_Helper_ListItemInGift
{
	public function listItemInGift($data,$view)
	{
		if(!$data)
			return;
		
		$xmlDoc = Utility::openXML(XML_PATH);
		$i = 1;
		foreach($data as $row)
		{
			switch ($row->type)
			{
				case 'exp':
					$strType = "Kinh nghiệm";
					break;
				case 'gold':
					$strType = "Vàng";
					break;
				case 'pig':
					$strType = "Heo";
					break;
				case 'item':
				case 'groupitem':
					$strType = "Item";
					break;
				case 'xu':
					$strType = "Xu";
					break;
				case 'kil':
					$strType = "Kim Ỉn Lệnh";
					break;
				case 'kiss':
					$strType = "Nụ hôn";
					break;
			}
			
			$name = "";
			$rank = $row->rank;
			if($row->type == 'pig')
			{
				$pig = PigManager::GetInstance()->LoadPigByType($xmlDoc,$row->object_id);				
				$name = $pig->name;
			}
			
			if($row->type == 'item' || $row->type == 'groupitem')
			{
				$item = ItemManager::GetInstance()->LoadItemById($xmlDoc, $row->object_id);
				$name = $item->name;
				
				if($row->type == 'item')
					$rank = "<span class='rank' id='rank_$row->id'>$row->rank</span>";
			}
			
			$strList .= "<tr>
							<td align='center'>$i</td>
							<td>$strType</td>
							<td>$name</td>
							<td align='center'>$rank</td>
							<td align='center'><span class='quantity' id='quantity_$row->id'>$row->quantity</span></td>
							<td align='center'><a href='javascript:deleteItem(\"$view->baseUrl/gift/deleteitem\",$row->id)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a></td>
						</tr>";
			
			$i++;
		}
		
		echo $strList;
	}
}

?>
