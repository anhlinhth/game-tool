<?php
class Zend_View_Helper_ListQuestLine
{
	public function listQuestLine($data, $curPage, $itemPerPage ,$view)
	{
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		$strList .= "<tbody>";
		foreach($data as $key =>$row)
		{					
			$edit = "";
			$delete = "";
			$privilege = "";					
				$edit = "<a class='tool-16 edit' href='javascript:editQuestLine($key)'></a>";				
				$delete = "<a class='tool-16 delete' href='javascript:deleteQuestLine($key)'></a>";;								
			$strList .= "<tr id='quest-line-$key'>							
							<td class='id'>$row->QuestLineID</td>	
							<td class='name'>$row->QuestLineName</td>
							<td class='QLIcon'>$row->QuestLineIcon</td>			
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
