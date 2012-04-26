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
			case 'tool':
				$selectTool = 'current';
				break;
            case 'shopeditor':
                $selectShopeditor = 'current';
                break;    
			case 'event':
				$selectEvent = 'current';
				break;
			case 'gift':
				$selectGift = 'current';
				break;
			case 'quest':
				$selectQuest = 'current';
				break;
			case 'campaign':
           	case 'soldier':
           	case 'typemap':
           	case 'awardtype':
			case 'layout':
           	case 'exportcamp': 
           	case 'restore':
           	case 'backup': 
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
        $strList .= "<li class='$localite'><a href='$view->baseUrl/localite/language'>Localize</a></li>";
		$strList .=		"</ul>
					</div>";
		
		echo $strList;
	}
}
?>
