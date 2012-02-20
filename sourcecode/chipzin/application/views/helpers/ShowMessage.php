<?php
class Zend_View_Helper_ShowMessage
{
	public function showMessage($msg)
	{
		$strList = "<div class='msg'>$msg</div>";
		echo $strList;
	}
}