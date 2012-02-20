<?php
class Zend_View_Helper_ListNamThienHitPig
{
	public function listNamThienHitPig($data,$view)
	{
		if(!$data)
			return;
		$i = 0;
		foreach($data as $row)
		{
			if(!$row)
				continue;
			$temp = explode(":", $row);
			$strList .= '<div id="dv_ahitpig_'. $i .'">Đập heo đất lần thứ <input type="text" value="'. $temp[0] .'" name="txtHit[]" style="width: 30px"/> thu được <input type="text" value="'. $temp[1] .'" name="txtHitPigCard[]" style="width: 30px"/> Kim Ỉn Lệnh&nbsp;&nbsp;&nbsp;&nbsp;<a name="ahitpig_'.  $i .'" onclick="deleteOption(this)" title="Xóa" href="javascript:;"><img src="'. $view->baseUrl .'/media/images/icons/delete.gif" /></a></div>';
			$i++;
		}
		
		echo $strList;
	}
}
?>
