<?php
class Zend_View_Helper_ListFile
{
	public function listFile($data, $curPage, $itemPerPage ,$view,$base)
	{
	
		if(!$data)
			return;
		$items = (($curPage - 1) * $itemPerPage) + 1;
		//$items=1;
		$strList = "<tbody>";
		foreach($data as $key =>$row)
		{	
			//var_dump($base)		;
			//die();		
			$edit = "";
			$delete = "";
			$privilege = "";	
			$name= $row['Name'];
			$time=$row['DateTime'];	
			$num=$row['Num'];
			if($num>($itemPerPage*($curPage-1)))
			{	
			$urll="$base/Export/$name";			
				$delete = "<a class='tool-24 delete' href='javascript:deleteres($key)'></a>";;	
			$strList .= "<tr id='Type-$key' height=\"60\">
							<td class='ID' >$items</td>
							<td class='Name' id= 'Id-$key'  width=\"180px\"><a href=\"$urll\"".">$name</a></td>							
							<td class='datatime'  width=\"180px\">$time</td>						
							<td align='center'>	$delete	</td>
						</tr>";
			
			$items++;
			if ($items>$itemPerPage*$curPage)
			break;
			}
		}
		
		$strList .= "</tbody>";		
		
		echo $strList;
	}
}
