<?php
class Zend_View_Helper_ListQuest2
{
	public function listQuest2($arrQuest,$arrAllQuest,$arrNextQuest,$Task, $curPage, $itemPerPage ,$view)
	{
		if(!$arrQuest)
			return;
		$md = new Models_Quest();
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "";		
		foreach($arrQuest as $row)
		{
			
			if($row->enabled)
				$strActive = "<span style='color:green; font-weight:bold'>Kích hoạt</span>";
			else
				$strActive = "";
			
			$edit = "<a href='$view->baseUrl/quest/edit/id/$row->QuestID'><img src='$view->baseUrl/media/images/icons/edit-icon.gif' title='Chỉnh sửa' width='16' height='16' /></a>";
			$delete = "<a href='javascript:deleteQuest($row->QuestID)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";

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
				foreach ($arrAllQuest as $row2)
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
				$strList.="</select></td>
				<td>";	
				$flag2 = 1;
				foreach($arrNextQuest[$row->QuestID] as $key => $nextQuestRow){
					if($nextQuestRow->NextQuest==NULL){
						$flag2 = 0;
					}
					$strList.= "<div class='next-quest-$row->QuestID' id='next-quest-div-$row->QuestID-$key'>							
							<select id='nextquest-$row->QuestID-$key' name='nextquest-$row->QuestID-$key' onChange='updateNextQuest($nextQuestRow->ID,$row->QuestID,$key);'>";
					$strList .= "<option selected  value=''>NULL</option>";		
					foreach ($arrAllQuest as $row3){
						$str="";
						if($nextQuestRow->NextQuest == $row3->QuestID)
						{							
							$str="selected";
						}						
						$strList .= "<option $str  value='$row3->QuestID'>$row3->QuestName</option>";	
					}
					$strList.= "</select>
					<a class='tool-16 delete' href='javascript:deleteNextQuest($row->QuestID,$nextQuestRow->ID,$key)'></a>
					<a class='tool-16 add' href='javascript:addNextQuest($row->QuestID,$key)'></a>
					</div>";
				}
				if(empty($arrNextQuest)){
					$flag2 = 0;
				}
				$strList.="</td>";	
				
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
						$strList.="<td align='center'><a title='NeedQuest or NextQuest is NULL!' class='ico-16 warning' id='warning'></a></td>";
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
		$strList .= "";		
		
		echo $strList;
	}
}
?>
