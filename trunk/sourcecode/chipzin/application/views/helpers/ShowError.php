<?php
class Zend_View_Helper_ShowError
{
	public function showError($data)
	{
		$strList = "";
		$strList .= "<div class='error'>
						<ul>";
		
		$errList = explode(";", $data);
		if(count($errList) == 0)
			return;
			
		foreach ($errList as $err)
		{
			if(!empty($err))
				$strList .= "<li>$err</li>";
		}
		
		$strList .= "</ul>";
		$strList .= "</div>";
		echo $strList;
	}
}