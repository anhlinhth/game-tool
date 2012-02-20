<?php
class Zend_View_Helper_ListNamThienQuest
{
	public function listNamThienQuest($data,$view)
	{
		if(!$data)
			return;
		$i = 0;
		foreach($data as $row)
		{
			if(!$row)
				continue;
			$temp = explode(":", $row);
			$strList .= '<div id="dv_aquest_'. $i .'">Hoàn thành nhiệm vụ thứ <input type="text" value="'. $temp[0] .'" name="txtQuest[]" style="width: 30px"/> thu được <input type="text" value="'. $temp[1] .'" name="txtQuestCard[]" style="width: 30px"/> Kim Ỉn Lệnh&nbsp;&nbsp;&nbsp;&nbsp;<a name="aquest_'.  $i .'" onclick="deleteOption(this)" title="Xóa" href="javascript:;"><img src="'. $view->baseUrl .'/media/images/icons/delete.gif" /></a></div>';
			$i++;
		}
		
		echo $strList;
	}
}
?>
