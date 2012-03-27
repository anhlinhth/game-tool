
<?php
class Zend_View_Helper_ListLayout
{
	public function listLayout($data, $curPage, $itemPerPage ,$view)
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
				$edit = "<a class='tool-16 edit' href='javascript:editLayout($row->ID,$row->Point)'></a>";	
				$delete = "<a class='tool-16 delete' href='javascript:deleteLayout($row->ID)'></a>";;								
			$strList .= "<tr id='$row->TaskID'>
							<td class='descid'>$row->ID</td>	
							<td class='desc'>$row->Name</td>		
							<td class='desc'>$row->Point</td>						
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
