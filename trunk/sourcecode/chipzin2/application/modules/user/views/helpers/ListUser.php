<?php
class Zend_View_Helper_ListUser
{
	public function listUser($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		
		$strList = "<tbody>";
		$mdGroup = new User_Model_Group();
		foreach($data as $row)
		{
			if($row->active)
				$strActive = "<span style='color:green; font-weight:bold'>Kích hoạt</span>";
			else
				$strActive = "";
			
			$edit = "<a href='$view->baseUrl/user/edit/id/$row->id'><img src='$view->baseUrl/media/images/icons/user_edit.png' title='Chỉnh sửa' width='16' height='16' /></a>";
			$delete = "<a href='javascript:deleteItem(\"$view->baseUrl/user/delete\",$row->id)'><img src='$view->baseUrl/media/images/icons/user_delete.png' title='Xóa' width='16' height='16' /></a>";
			
			if($row->username == 'admin')
			{
				$edit = "";
				$delete = "";
			}			
			
			$group = $mdGroup->_getByKey($row->group_id);
			
			$strList .= "<tr>
							<td align='center'>$items</td>
							<td><a href='#'>$row->username</a></td>
							<td>$row->fullname</td>
							<td align='center'>$group->name</td>
							<td align='center'>$strActive</td>
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
