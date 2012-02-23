<?php
class Zend_View_Helper_ListQuestAwardItems
{
	public function listQuestAwardItems($data)
	{
		
		$strList .= "";		
		foreach($data as $key =>$row)
		{
			//$key = $key+1;
			$strList.= "<div class='awarditem' id='award_$key'><label></label><input name='awarditem[]' value='$row->AwardItem' id='' type='text' tabindex='1' />
			<a title='Add Item' href='javascript:addAwardItem(award_$key)'><img style='vertical-align: middle' src='/vng/game-tool/sourcecode/chipzin/media/images/icons/add.png'></a>
			<a title='Delete Item' href='javascript:deleteAwardItem(award_$key)'><img style='vertical-align: middle' src='/vng/game-tool/sourcecode/chipzin/media/images/icons/delete.gif'></a>
			</div>";
		}		
		$strList .= "<br/>";	
		echo $strList;
	}
}
?>
