<?php
class Zend_View_Helper_TopMenu
{
	public function topMenu($view)
	{
		switch ($view->controllerName)
		{
			case 'user':
				$selectUser = 'current';
				break;
			case 'group':
				$selectGroup = 'current';
				break;			
			case 'quest':
			case 'questline':	
				$selectQuest = 'current';
				break;
			case 'campaign':
				$campaign = 'current';
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
                
		$strList .=		"</ul>
					</div>";
		
		echo $strList;
	}
}
?>
