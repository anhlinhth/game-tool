<?php
class Zend_View_Helper_SelectionSolider
{
	public function selectionSolider($data,$selected,$name,$arrParram)
	{
		$strList .= "<select id='$name' name='$name' tabindex='2'>";
		if(isset($arrParram['default'])){
			$val = $arrParram['default'];
			$strList .= "<option value='$val'></option>";
		}	
		if(isset($arrParram['key']) && $data && isset($arrParram['name'])){
			$key = $arrParram['key'];
			$name = $arrParram['name'];
			
			foreach($data as $row)
				{
					if($row[$key] == $selected)
						$strSelect = 'selected';
					else
						$strSelect = '';
					$strList .= "<option $strSelect value=$row[$key]>$row[$name]</option>";
				}
		}				
		$strList .= "</select>";
		
		echo $strList;
	}

}
?>
