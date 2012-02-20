<?php
class Zend_View_Helper_SelectQuestLine
{
	public function selectQuestLine($selected)
	{
		$strList .= "<select id='type' name='type' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";	
		$strList .= "<option value='0'></option>";
		$strList .= "<option selected ='yes' value=''>$selected</option>";
		$strList .= "<option selected ='' value=''>2</option>";
		$strList .= "</select>";
		
		echo $strList;
	}
}
?>
