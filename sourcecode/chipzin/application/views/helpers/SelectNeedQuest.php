<?php
class Zend_View_Helper_SelectNeedQuest
{
	public function selectNeedQuest($selected, $arrQuest)
	{
		$strList .= "<select id='type' name='need-quest[]' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";	
		//$strList .= "<option $slt value='". $value->QuestLineID ."'>$value->QuestLineID</option>";
		$strList .= "<option value='' selected ></option>";
		$slt="";
		if(!empty($arrQuest)){
			foreach ($arrQuest as $row) {
				$slt = "";
				if($row->QuestID == $selected){
					$slt = "selected";
				}		
				$strList .= "<option $slt value='". $row->QuestID ."'>(ID:$row->QuestID $row->QuestName )</option>";
			}		
			$strList .= "</select>";			
		}
		
		
		echo $strList;
	}
}
?>
