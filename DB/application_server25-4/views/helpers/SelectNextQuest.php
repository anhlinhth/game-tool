	<?php
class Zend_View_Helper_SelectNextQuest
{
	public function selectNextQuest($selected, $arrValue)
	{
		$strList .= "<select id='NextQuest' name='NextQuest' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";	
		//$strList .= "<option $slt value='". $value->QuestLineID ."'>$value->QuestLineID</option>";
		$strList .= "<option value='' selected ></option>";
		$slt="";
		foreach ($arrValue as $row) {
			if($row->QuestID == $selected){
				$slt = "selected";
			}else{
				$slt = "";	
			}			
			$strList .= "<option $slt value='". $row->QuestID ."'>(ID:$row->QuestID) $row->QuestName </option>";
		}		
		$strList .= "</select>";		
		echo $strList;
	}
}
?>
