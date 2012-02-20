<?php
class Zend_View_Helper_ListNamThienBuyKiss
{
	public function listNamThienBuyKiss($data,$view)
	{
		if(!$data)
			return;
		$i = 0;
		foreach($data as $row)
		{
			if(!$row)
				continue;
			$temp = explode(":", $row);
			$strList .= '<div id="dv_akiss_'. $i .'">Mua <input type="text" name="txtKiss[]" value="'. $temp[0] .'" style="width: 30px"/> nụ hôn được <input type="text" value="'. $temp[1] .'" name="txtKissCard[]" style="width: 30px"/> Kim Ỉn Lệnh&nbsp;&nbsp;&nbsp;&nbsp;<a name="akiss_'.  $i .'" onclick="deleteOption(this)" title="Xóa" href="javascript:;"><img src="'. $view->baseUrl .'/media/images/icons/delete.gif" /></a></div>';
			$i++;
		}
		
		echo $strList;
	}
}
?>
