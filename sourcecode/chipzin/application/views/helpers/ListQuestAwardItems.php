<?php
class Zend_View_Helper_ListQuestAwardItems
{
	public function listQuestAwardItems($data)
	{
		
		$strList = "";
		if(empty($data)){
			echo $strList;
			return;
		}
				
		foreach($data as $key =>$row)
		{
			//$key = $key+1;
			$strList.= "<div class='awarditem' id='award_$key'><label></label><input name='awarditem[]' value='$row->AwardItem' id='' type='text' tabindex='1' />
			
			<a title='Delete Item' href='javascript:deleteAwardItem($key)'>Delete</a>
			</div>";
		}		
		$strList .= "<br/>";	
		echo $strList;
	}
}
?>