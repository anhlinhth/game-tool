<?php
class Zend_View_Helper_SelectNeedQuest
{
	public function selectNeedQuest($selected, $arrQuest)
	{
		$strList .= "<select id='type' name='need-quest[]' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";	
		//$strList .= "<option $slt value='". $value->QuestLineID ."'>$value->QuestLineID</option>";
		$strList .= "<option value='' selected ></option>";
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
