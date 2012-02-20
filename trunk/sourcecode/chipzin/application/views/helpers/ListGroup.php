<?php
class Zend_View_Helper_ListGroup
{
	public function listGroup($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";
		foreach($data as $row)
		{
			if($row->active)
				$strActive = "<span style='color:green; font-weight:bold'>Kích hoạt</span>";
			else
				$strActive = "";
			
			$edit = "";
			$delete = "";
			$privilege = "";
			
			if($row->id != 1) //Id cua group admin khong cho sua
			{
				$edit = "<a href='$view->baseUrl/group/edit/id/$row->id'><img src='$view->baseUrl/media/images/icons/edit-icon.gif' title='Chỉnh sửa' width='16' height='16' /></a>";
				$privilege = "<a href='$view->baseUrl/group/privilege/id/$row->id'><img src='$view->baseUrl/media/images/icons/bricks_gear.png' title='Phân quyền' width='16' height='16' /></a>";
				$delete = "<a href='javascript:deleteItem(\"$view->baseUrl/group/delete\",$row->id)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";
			}			
			
			$strList .= "<tr>
							<td class='a-center'>$items</td>
							<td>$row->name</td>							
							<td align='center'>								
								$edit&nbsp;
								$privilege&nbsp;	
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
