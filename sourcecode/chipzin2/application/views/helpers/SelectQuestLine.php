<?php
class Zend_View_Helper_SelectQuestLine
{
	public function selectQuestLine($selected, $arrValue)
	{
		$strList .= "<select id='type' name='QuestLine' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";	
		$slt = "";	
		foreach ($arrValue as $value) {				
			if($selected ==  $value->QuestLineID )
				$slt = "selected";	
			$strList .= "<option $slt value='". $value->QuestLineID ."'>$value->QuestLineName</option>";
		}
		if($slt != "selected")
			$strList .= "<option value='0' selected ></option>";
		$strList .= "</select>";
		
		echo $strList;
	}
}
?>
