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
			$strList.= "
				<div class='award_item' id='award_item_$key'>
				<label></label><input name='awarditem[$row->ID]' value='$row->AwardItem' id='' type='text' tabindex='1' />			
				<a class='tool-16 delete' title='Delete Item' href='javascript:deleteAwardItem($key)'></a>
				</div>";
		}		
		$strList .= "";	
		echo $strList;
	}
}
?>
