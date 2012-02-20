<?php
class Zend_View_Helper_Selection
{
	public function selection($data,$selected,$id,$default=true)
	{
		$strList .= "<select id='$id' name='$id' tabindex='2'>";
		if($default)
			$strList .= "<option value='0'></option>";
		
		if($data)
		{
			foreach($data as $row)
			{
				if($row['id'] == $selected)
					$strSelect = 'selected';
				else
					$strSelect = '';
				$strList .= "<option $strSelect value='{$row['id']}'>{$row['name']}</option>";
			}
		}
		
		$strList .= "</select>";
		
		echo $strList;
	}
}
?>
