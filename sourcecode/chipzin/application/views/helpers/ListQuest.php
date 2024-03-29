<?php
class Zend_View_Helper_ListQuest
{
	public function listQuest($data,$data2,$Task, $curPage, $itemPerPage ,$view)
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
			$delete = "<a href='javascript:deletez(\"$view->baseUrl/quest/delete\",$row->QuestID)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";

		//	luu y
		//	$objSearch->gift_package_id = $row->id;
		//	$count = $md->_count($objSearch);
			
			if($count > 0)
				$src = "$view->baseUrl/media/images/icons/cartfull.png";
			else
				$src = "$view->baseUrl/media/images/icons/cart.png";
			
			$addContent = "<a href='$view->baseUrl/gift/item/id/$row->id'><img src='$src' title='Chỉnh sửa' width='16' height='16' /></a>";
						
			$strList .= "<tr>
							<td align='center'><input type='checkbox' name='chkid' value='$row->QuestID' /></td>
							<td class='center'>$row->QuestID</td>
							<td>$row->QuestName</td>							
							<td>$row->QuestLineName</td>
							<td>
								<select width='30' name='needquest-$row->QuestID' id='needquest-$row->QuestID' class='needquest' onChange='updateNeedquest($row->QuestID);' > 
							";
			    $strList .= "<option selected  value=''>NULL</option>";
			    $flag1 = 0;
			    $flag2 = 0;
				foreach ($data2 as $row2)
				{
					if($row->QuestID != $row2->QuestID)
					{
						$str="";
						if($row->NeedQuest== $row2->QuestID)
						{
							$flag1 = 1;
							$str="selected";
						}
							$strList .= "<option $str  value='$row2->QuestID'>$row2->QuestName</option>";
					}
				}
				$strList.="</select>
							</td>
							<td>
							<select id='nextquest-$row->QuestID' name='nextquest-$row->QuestID' onChange='updateNextquest($row->QuestID);' >";
				$strList .= "<option selected  value=''>NULL</option>";
				foreach ($data2 as $row3)
				{
					$str="";
					if($row->NextQuest == $row3->QuestID)
					{
						$flag2 = 1;
						$str="selected";
					}
					$strList .= "<option $str  value='$row3->QuestID'>$row3->QuestName</option>";
				}
					
				$strList.="</select>
							</td>";
				$flagtask = 0;
				foreach ($Task as $taskrow)
				{
					if($row->QuestID == $taskrow->QuestID)
					{
						$flagtask = 1;
						break;
					}
				}
				if($flagtask == 0)
				{
					$strList.="<td align='center'><a title='Quest chưa có Task nào' class='ico-16 errors' id='error'></a></td>";
				}
				else 
				{
					if($flag1 == 0 || $flag2 == 0)
					{	
						$strList.="<td align='center'><a title='NeedQuest hoặc NextQuest đang để trống' class='ico-16 warning' id='warning'></a></td>";
					}
					else
					{
						$strList.="<td align='center'><a title='Ok' class='ico-16 ok' id='ok'></a></td>";
					}
				}
				$strList.="<td align='center'>	
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
