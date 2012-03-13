
<?php
class Zend_View_Helper_ListTemplate
{
	public function listTemplate($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";
		foreach($data as $row)
		{					
			$edit = "";
			$delete = "";
			$privilege = "";					
				$edit = "<a href='$view->baseUrl/template/edit/id/$row->TaskID'><img src='$view->baseUrl/media/images/icons/edit-icon.gif' title='Chỉnh sửa' width='16' height='16' /></a>";
				$delete = "<a href='javascript:deleteItem(\"$view->baseUrl/template/delete\",$row->TaskID)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";								
			$strList .= "<tr id='$row->TaskID'>
							<td class='descid'>$row->TaskID</td>	
							<td class='desc'>$row->TaskName</td>		
							<td class='desc'>$row->ActionName</td>	
							<td class='desc'>$row->QTC_Name</td>					
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
<script type="text/javascript">	
	$(function(){
		$(".edit").click(function(){			
			parent = $(this).parent().parent();
			value = $(parent).children(".desc").text();
			value2= $(parent).children(".descid").text();
			document.getElementById('desc1').value = value;
			document.getElementById('QTC_ID1').value = value2;
			return false;
		});
	});	
</script>
