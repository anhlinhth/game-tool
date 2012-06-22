<?php
class Zend_View_Helper_TopMenu
{
	public function topMenu($view)
	{
		switch ($view->controllerName)
		{
			
			case 'language':
			case 'lgroup':
			case 'string':
			case 'string2':
			case 'iefile':
				$localize = 'current';
				break;		
		}
		
		$strList .= "<div id='topmenu'>
						<ul>";
		
		if(Utility::checkPrivilege($view, "user", "index"))
			$strList .= "<li class='$selectUser'><a href='$view->baseUrl/user/index'>Người dùng</a></li>";	
		
		if(Utility::checkPrivilege($view, "group", "index"))
			$strList .= "<li class='$selectGroup'><a href='$view->baseUrl/group/index'>Nhóm</a></li>";
		

        if(Utility::checkPrivilege($view, "quest", "index"))
            $strList .= "<li class='$selectQuest'><a href='$view->baseUrl/quest/index'>Quest</a></li>"; 

        
        $strList .= "<li class='$campaign'><a href='$view->baseUrl/campaign/campaign'>Campaign</a></li>";        
        $strList .= "<li class='$localize'><a href='$view->baseUrl/localize/language'>Localize</a></li>";
		if(Utility::checkPrivilege($view, "compensation", "index"))
        	$strList .= "<li class='$compensation'><a href='$view->baseUrl/compensation/compensation'>Compensation</a></li>";    
        $strList .= "<li class='$shop'><a href='$view->baseUrl/shop/shop'>Shop</a></li>";
		$strList .=		"</ul>
					</div>";
		    
		echo $strList;
	}
}
?>
