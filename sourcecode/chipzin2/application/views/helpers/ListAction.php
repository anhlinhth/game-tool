<?php
class Zend_View_Helper_ListAction
{
	public function listAction($data, $curPage, $itemPerPage ,$view)
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
				$edit = "<a class='edit' href='#'><img src='$view->baseUrl/media/images/icons/edit-icon.gif' title='ChÃ¡Â»â€°nh sÃ¡Â»Â­a' width='16' height='16' /></a>";
				//$privilege = "<a href='$view->baseUrl/questline/privilege/id/$row->id'><img src='$view->baseUrl/media/images/icons/bricks_gear.png' title='PhÃƒÂ¢n quyÃ¡Â»ï¿½n' width='16' height='16' /></a>";
				//$delete = "<a href='javascript:show($row->id)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='XÃƒÂ³a' width='16' height='16' /></a>";
				$delete = "<a href='javascript:deleteItem(\"$view->baseUrl/Action/delete\",$row->ActionID);window.location.reload();'><img src='$view->baseUrl/media/images/icons/delete.gif' title='XÃƒÂ³a' width='16' height='16' /></a>";								
			$strList .= "<tr id='$row->ActionID'>
							<td class='a-center'>$items</td>
							<td class='descid'>$row->ActionID</td>	
							<td class='desc'>$row->ActionName</td>						
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
			document.getElementById('questlineid1').value = value2;
			return false;
		});
	});	
</script>
