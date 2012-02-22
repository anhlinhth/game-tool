<?php
class Zend_View_Helper_SelectQuestLine2
{
	public function selectQuestLine2($selected, $arrValue)
	{
		$strList .= "<select id='type' name='QuestLineID' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";	
		//$strList .= "<option $slt value='". $value->QuestLineID ."'>$value->QuestLineID</option>";
		//$strList .= "<option value='".$selected."' selected >".$selected."</option>";
		$slt="";
		foreach ($arrValue as $value) {
			if($value->QuestLineID == $selected){
				$slt = "selected";
			}else{
				$slt = "";	
			}			
			$strList .= "<option $slt value='". $value->QuestLineID ."'>$value->QuestLineName</option>";
		}
		
		$strList .= "</select>";
		
		echo $strList;
	}
}
?>
