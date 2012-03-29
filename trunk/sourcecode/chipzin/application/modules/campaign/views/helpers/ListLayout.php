
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
			$arrCheck = array();
			$flag = 0;
			$i = 1;
			while ($i < 18)
			{
				if($row->Point[$i] == '1')
				{
					$arrCheck[$flag] = 'checked';
				}
				else 
				{
					$arrCheck[$flag] = '';
				}
				$flag++;
				$i += 2;
			}
			$edit = "";
			$delete = "";
			$privilege = "";					
				$edit = "<a class='tool-16 edit' href='javascript:editLayout($row->ID,$row->Point)'></a>";	
				$delete = "<a class='tool-16 delete' href='javascript:deleteLayout($row->ID)'></a>";;								
			$strList .= "<tr id='$row->TaskID'>
							<td class='descid'>$row->ID</td>	
							<td class='desc'>$row->Name</td>		
							<td class='desc'>
								<table>
									<tr>
										<td>1<input type='checkbox' disabled $arrCheck[0] name='point$row->ID' id='0_$row->ID' value='0' /></td>
										<td>4<input type='checkbox' disabled $arrCheck[3] name='point$row->ID' id='3_$row->ID' value='3' /></td>
										<td>7<input type='checkbox' disabled $arrCheck[6] name='point$row->ID' id='6_$row->ID' value='6' /></td>
									</tr>
									<tr>
										<td>2<input type='checkbox' disabled $arrCheck[1] name='point$row->ID' id='1_$row->ID' value='1' /></td>
										<td>5<input type='checkbox' disabled $arrCheck[4] name='point$row->ID' id='4_$row->ID' value='4' /></td>
										<td>8<input type='checkbox' disabled $arrCheck[7] name='point$row->ID' id='7_$row->ID' value='7' /></td>
									</tr>
									<tr>
										<td>3<input type='checkbox' disabled $arrCheck[2] name='point$row->ID' id='2_$row->ID' value='2' /></td>
										<td>6<input type='checkbox' disabled $arrCheck[5] name='point$row->ID' id='5_$row->ID' value='5' /></td>
										<td>9<input type='checkbox' disabled $arrCheck[8] name='point$row->ID' id='8_$row->ID' value='8' /></td>
									</tr>
								</table>		
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
			document.getElementById('desc1').value = value;
			document.getElementById('QTC_ID1').value = value2;
			return false;
		});
	});	
</script>
