<?php
class Zend_View_Helper_SelectNextQuest
{
	public function selectNextQuest($selected, $arrQuest)
	{
		$strList .= "<select id='type' name='NextQuest' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";	
		//$strList .= "<option $slt value='". $value->QuestLineID ."'>$value->QuestLineID</option>";
		$strList .= "<option value='NULL ' selected ></option>";
		$slt="";
		foreach ($arrQuest as $value) {
			if($value->QuestID == $selected){
				$slt = "selected";
			}else{
				$slt = "";	
			}			
			$strList .= "<option $slt value='". $value->QuestID ."'>$value->QuestName</option>";
		}
		
		$strList .= "</select>";
		
		echo $strList;
	}
}
?>
