<?php
class Zend_View_Helper_TopMenu
{
	public function topMenu($view)
	{
		$strList   ="";
		$module = $view->arrParam['module'];
		
		
		
		
		
		
		// if(Utility::checkPrivilege($view, "user", "index"))	
		// if(Utility::checkPrivilege($view, "group", "index"))
        // if(Utility::checkPrivilege($view, "quest", "index"))
		
		$strList .= "<div id='topmenu'>
						<ul>";
		$selectUser ="";				
        $strList .= "<li class='$selectUser'><a href='$view->baseUrl/user/user/index'>Người dùng</a></li>";
		
		// $selectGroup = "";
		// $strList .= "<li class='$selectGroup'><a href='$view->baseUrl/group/index'>Nhóm</a></li>";
		
		$selectQuest = "";
        $strList .= "<li class='$selectQuest'><a href='$view->baseUrl/quest/index'>Quest</a></li>";
		
		$selectCampaign = "";
        $strList .= "<li class='$selectCampaign'><a href='$view->baseUrl/campaign/campaign'>Campaign</a></li>";   
		
		$selectCompensation = "";
        $strList .= "<li class='$selectCompensation'><a href='$view->baseUrl/compensation/compensation'>Compensation</a></li>";  
		
		$strList .=	"</ul>
					</div>";
		
		echo $strList;
	}
}
?>
