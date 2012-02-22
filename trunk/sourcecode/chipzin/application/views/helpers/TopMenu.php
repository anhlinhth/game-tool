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
			case 'questline':
				$selectQuest = 'current';
				break;		
		}
		
		$strList .= "<div id='topmenu'>
						<ul>";
		
		if(Utility::checkPrivilege($view, "user", "index"))
			$strList .= "<li class='$selectUser'><a href='$view->baseUrl/user/index'>Người dùng</a></li>";	
		
		if(Utility::checkPrivilege($view, "group", "index"))
			$strList .= "<li class='$selectGroup'><a href='$view->baseUrl/group/index'>Nhóm</a></li>";
		
		
		if(Utility::checkPrivilege($view, "tool", "index"))
			$strList .= "<li class='$selectTool'><a href='$view->baseUrl/tool/index'>Công cụ</a></li>";
            
        if(Utility::checkPrivilege($view, "shopeditor", "index"))
            $strList .= "<li class='$selectShopeditor'><a href='$view->baseUrl/shopeditor/index'>Shop Editor</a></li>";    
		
		if(Utility::checkPrivilege($view, "event", "index"))
			$strList .= "<li class='$selectEvent'><a href='$view->baseUrl/event/index'>Sự kiện</a></li>";
		
		if(Utility::checkPrivilege($view, "gift", "index"))
			$strList .= "<li class='$selectGift'><a href='$view->baseUrl/gift/index'>Gói phần thưởng</a></li>";	
		
        if(Utility::checkPrivilege($view, "ibshop", "index"))
            $strList .= "<li class='$selectGift'><a href='$view->baseUrl/ibshop/index'>IBShop</a></li>";    
		
        if(Utility::checkPrivilege($view, "quest", "index"))
            $strList .= "<li class='$selectQuest'><a href='$view->baseUrl/quest/index'>Quest</a></li>"; 
		$strList .=		"</ul>
					</div>";
		
		echo $strList;
	}
}
?>
