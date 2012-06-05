<?php
class Zend_View_Helper_TopMenu
{
	public function topMenu($view)
	{
		
		$module = $view->arrParam["module"];
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
			
		}
		
		
		switch ($module)
		{
			case 'campaign':
				$selectCampaign = 'current';
				break;
			case 'localize':
				$selectLocalize = 'current';
				break;				
			case 'shop':
				$selectShop = 'current';
				break;
			case 'compensation':
				$selectCompensation = 'current';
				break;
		}
		
		
		$strList .= "<div id='topmenu'>
						<ul>";
		
		// if(Utility::checkPrivilege($view, "user", "index"))
			$strList .= "<li class='$selectUser'><a href='$view->baseUrl/user/index'>Người dùng</a></li>";	
		
		// if(Utility::checkPrivilege($view, "group", "index"))
			$strList .= "<li class='$selectGroup'><a href='$view->baseUrl/group/index'>Nhóm</a></li>";
		
        // if(Utility::checkPrivilege($view, "quest", "index"))
            $strList .= "<li class='$selectQuest'><a href='$view->baseUrl/quest/index'>Quest</a></li>"; 

        // if(Utility::checkPrivilege($view, "quest", "index"))
        	 $strList .= "<li class='$selectCampaign'><a href='$view->baseUrl/campaign/campaign'>Campaign</a></li>";
        
        // if(Utility::checkPrivilege($view, "quest", "index"))
        	$strList .= "<li class='$selectLocalize'><a href='$view->baseUrl/localize/string2?size=100'>Localize</a></li>";
        //if(Utility::checkPrivilege($view, "compensation", "index"))
        	$strList .= "<li class='$selectCompensation'><a href='$view->baseUrl/compensation/compensation'>Compensation</a></li>";
       	// if(Utility::checkPrivilege($view, "shop", "index"))       	     
        	$strList .= "<li class='$selectShop'><a href='$view->baseUrl/shop/shop'>Shop</a></li>";
		// if(Utility::checkPrivilege($view, "shop", "index"))       	     
        	//$strList .= "<li class='$selectCompensation'><a href='$view->baseUrl/compensation/compensation'>Shop</a></li>";
		$strList .=		"</ul>
					</div>";
		
		echo $strList;
	}
}
?>
