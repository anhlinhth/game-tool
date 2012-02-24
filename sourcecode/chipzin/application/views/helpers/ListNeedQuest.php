<?php
class Zend_View_Helper_ListNeedQuest
{
	public function listNeedQuest($arrNeedQuest,$arrQuest)
	{

		$strList .= "";		
		foreach($arrNeedQuest as $key =>$row)
		{			
			$slt="";
			$strSelectQuest="";
			$strSelectQuest .= "<select  id='type' name='need-quest[]' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";			
			$strSelectQuest.="<option value='0'></option>";
			$num = $key + 1;	
			foreach ($arrQuest as $q_value) {
				$slt="";	
				if($q_value->QuestID == $row->NeedQuest){
					$slt="selected";		
				}
				$strSelectQuest .= "<option $slt value='". $q_value->QuestID ."'>$q_value->QuestName</option>";
			}
			$strSelectQuest .= "</select>";
			$strList.="<div class='need_quest' id='need_quest_$num'><label></label>".$strSelectQuest."			
			<a title='Delete Item' href='javascript:deleteNeedQuest($num)'>Delete</a>
			</div>";
		}		
			
		echo $strList;
	}
}
?>
