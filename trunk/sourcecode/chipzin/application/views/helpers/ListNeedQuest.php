<?php
class Zend_View_Helper_ListNeedQuest
{
	public function listNeedQuest($arrNeedQuest,$arrQuest)
	{

		$strList = "";	
		if(empty($arrNeedQuest)){		
			echo $strList;
			return;
		}
			
		foreach($arrNeedQuest as $key =>$row)
		{			
			$slt="";
			$strSelectQuest="";
			$strSelectQuest .= "<select class='need-quest' name='need-quest[$row->ID]' style='margin-bottom:5px;margin-top:5px;min-width:50px'>";			
			$strSelectQuest.="<option value=''></option>";
			$num = $key + 1;	
			foreach ($arrQuest as $q_value) {
				$slt="";	
				if($q_value->QuestID == $row->NeedQuest){///need quest da chon
					$slt="selected";		
				}
				$strSelectQuest .= "<option class='data' $slt value='". $q_value->QuestID ."'>(ID:$q_value->QuestID) $q_value->QuestName</option>";
			}
			$strSelectQuest .= "</select>";
			$strList.="<div class='need_quest' id='need_quest_$num'><label></label>".$strSelectQuest."<a class='tool-16 delete' title='Delete Item' href='javascript:deleteNeedQuest($num)'></a>
			</div>";
		}		
			
		echo $strList;
	}
}
?>
