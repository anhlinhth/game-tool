
<?php
class Zend_View_Helper_ListCamp
{
	public function listCamp($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";
		$mdm = new Models_WorldMap();
		$data2 = $mdm->fetchall();
		$mdc = new Models_Campaign();
		$data3 = $mdc->fetchall();
		foreach($data as $row)
		{					
			$edit = "";
			$delete = "";
			$privilege = "";					
				$edit = "<a class='edit' href='#'><img src='$view->baseUrl/media/images/icons/edit-icon.gif' title='Chỉnh sửa' width='16' height='16' /></a>";
				//$privilege = "<a href='$view->baseUrl/questline/privilege/id/$row->id'><img src='$view->baseUrl/media/images/icons/bricks_gear.png' title='Phân quyền' width='16' height='16' /></a>";
				//$delete = "<a href='javascript:show($row->id)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";
				$delete = "<a href='javascript:deleteItem(\"$view->baseUrl/campaign/campaign/delete\",$row->ID)'><img src='$view->baseUrl/media/images/icons/delete.gif' title='Xóa' width='16' height='16' /></a>";								
			$strList .= "<tr id='$row->ID'>
							<td class='a-center'>$items</td>
							<td class='descid'>$row->ID</td>	
							<td class='desc'>$row->Name</td>
							<td class='desc2'><center>
							<select id='nextquest-$row->ID' name='nextquest-$row->ID' onChange='changeMap($row->ID)'>
							";
			foreach ($data2 as $row1)
			{
					if($row1->ID==$row->WorldMap)
						$strList.="<option selected="."selected".">$row1->Name</option>";
					else 
						$strList.="<option>$row1->Name</option>";
			}
			$strList.="
							</select></center></td>
							<td class='desc3'>
							<center>
							<select id='type-$row->ID' name='type-$row->ID' onChange='changeMap1($row->ID)'>
							";
						
								if($row->TypeID==1)
								{
									$strList.="<option selected="."selected".">Map</option>";
									$strList.="<option >BARRAC</option>";
								}
								else
								{
									$strList.="<option selected="."selected".">Map</option>";
									$strList.="<option selected="."selected".">BARRAC</option>";
								}
			$strList.="
							</select></center>
							</td>
							<td>
							<center>
							<select id='nextquest-$row->ID' name='nextquest-$row->ID' onChange='changeMap($row->ID)'>
							";
					foreach ($data as $row1)
					{
							if($row->ID==$row1->ID)
								$strList .= "<option selected="."selected".">$row1->NeedCamp</option>";
							else
								$strList .= "<option>$row1->ID</option>";
					}
							$strList .= "
							</select>
							</center>
							</td>
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
			value3= $(parent).children(".desc2").text();
			value4= $(parent).children(".desc3").val();
			document.getElementById('desc1').value = value;
			document.getElementById('ID1').value = value2;
			document.getElementById('select1').value = value3;
			document.getElementById('select2').value = value4;
			return false;
		});
	});
	
</script>
