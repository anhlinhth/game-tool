<?php
class Zend_View_Helper_SelectTypeOfGiftPackage
{
	public function selectTypeOfGiftPackage($selected)
	{
		$strList .= "<select id='type' name='type' style='margin-bottom:5px;margin-top:5px'>";
		$strList .= "<option value='0'></option>";
		
		$selectedReward = "";
		$selectedSellOff = "";
		
		switch ($selected)
		{
			case GIFT_TYPE_REWARD:
				$selectedReward = 'selected';
				break;
			case GIFT_TYPE_SELLOFF:
				$selectedSellOff = 'selected';
				break;
		}
		
		$strList .= "<option $selectedReward value='". GIFT_TYPE_REWARD ."'>Gói phần thưởng</option>";
		$strList .= "<option $selectedSellOff value='". GIFT_TYPE_SELLOFF ."'>Gói giảm giá</option>";
		$strList .= "</select>";
		
		echo $strList;
	}
}
?>
