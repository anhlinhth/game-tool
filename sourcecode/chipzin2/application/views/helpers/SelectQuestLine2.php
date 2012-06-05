<?php
class Zend_View_Helper_SelectQuestLine2
{
	public function selectQuestLine2($selected, $arrValue)
	{
		$strList .= "<select id='QuestLineID' name='QuestLineID' style='margin-bottom:5px;margin-top:5px;min-width:50px' tabindex='1'>";		
		$slt="";
		if(!empty($arrValue)){
			foreach ($arrValue as $row) {
			if($row->QuestLineID == $selected){
				$slt = "selected";
			}else{
				$slt = "";	
			}			
			$strList .= "<option $slt value='". $row->QuestLineID ."'>$row->QuestLineName</option>";
			}		
		}		
		$strList .= "</select>";		
		echo $strList;
	}
}
?>
