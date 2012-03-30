<?php
class Zend_View_Helper_TopPanel
{
    public function topPanel ($controllerName, $view)
    {
        if ($controllerName == 'auth' || $controllerName == 'error')
            return;
        $strList .= "<div id='top-panel'>
						 <div id='panel'>";
        $strList .= "<ul>";
        switch ($controllerName) {
            case 'user':
                if (Utility::checkPrivilege($view, 'user', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/user/index' class='report'>Danh sách</a></li>";
                if (Utility::checkPrivilege($view, 'user', 'add'))
                    $strList .= "<li><a href='$view->baseUrl/user/add' class='useradd'>Thêm người dùng</a></li>";
                if (Utility::checkPrivilege($view, 'user', 'log'))
                    $strList .= "<li><a href='$view->baseUrl/user/log' class='search'>Theo dõi</a></li>";
                break;
            case 'tool':
                if (Utility::checkPrivilege($view, 'tool', 'notice'))
                    $strList .= "<li><a href='$view->baseUrl/tool/notice' class='feed'>Thông báo</a></li>";
                if (Utility::checkPrivilege($view, 'tool', 'compensation'))
                    $strList .= "<li><a href='$view->baseUrl/tool/compensation' class='promotions'>Đền bù</a></li>";
                if (Utility::checkPrivilege($view, 'tool', 'popup'))
                    $strList .= "<li><a href='$view->baseUrl/tool/popup' class='popup'>Popup</a></li>";
                if (Utility::checkPrivilege($view, 'tool', 'compensationplayer'))
                    $strList .= "<li><a href='$view->baseUrl/tool/compensationplayer' class='compensationplayer'>Đền bù player</a></li>";
                if (Utility::checkPrivilege($view, 'tool', 'reason'))
                    $strList .= "<li><a href='$view->baseUrl/tool/reason' class='denbu'>Lý do [New]</a></li>";
                if (Utility::checkPrivilege($view, 'tool', 'denbu'))
                    $strList .= "<li><a href='$view->baseUrl/tool/denbu' class='denbu'>Đền bù [New]</a></li>";
                if (Utility::checkPrivilege($view, 'tool', 'approve'))
                    $strList .= "<li><a href='$view->baseUrl/tool/approve' class='approve'>Duyệt đền bù</a></li>";
                if (Utility::checkPrivilege($view, 'tool', 'statistic'))
                    $strList .= "<li><a href='$view->baseUrl/tool/statistic' class='statistic'>Thống kê đền bù</a></li>";
                break;
            case 'group':
                if (Utility::checkPrivilege($view, 'group', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/group/index' class='report'>Danh sách</a></li>";
                if (Utility::checkPrivilege($view, 'group', 'add'))
                    $strList .= "<li><a href='$view->baseUrl/group/add' class='add'>Thêm nhóm</a></li>";
                break;
            case 'questline':               
            case 'QTC':
           	case 'action':
            case 'export':
            case 'quest':
            	if (Utility::checkPrivilege($view, 'quest', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/quest/index' class='report'>Quest</a></li>";               
                if (Utility::checkPrivilege($view, 'questline', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/questline/index' class='report'>Quest Line</a></li>";
                if (Utility::checkPrivilege($view, 'QTC', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/QTC/index' class='report'>Quest Task Client</a></li>";
                    if (Utility::checkPrivilege($view, 'quest', 'import'))
                    $strList .= "<li><a href='$view->baseUrl/quest/import' class='report'>Import Define</a></li>";
                      if (Utility::checkPrivilege($view, 'quest', 'import'))
                    $strList .= "<li><a href='$view->baseUrl/export/export' class='report'>Export Define</a></li>";
                    if (Utility::checkPrivilege($view, 'action', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/action/index' class='report'>Action</a></li>";
                  if (Utility::checkPrivilege($view, 'export', 'download'))
                    $strList .= "<li><a href='$view->baseUrl/export/download' class='report'>Download Export</a></li>";  
                break;
            case 'campaign':
           	case 'soldier':
           	case 'typemap':
           	case 'awardtype': 
           	case 'exportcamp':	   
            	if (Utility::checkPrivilege($view, 'campaign', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/campaign/campaign/index' class='report'>Campaign Manager</a></li>";               
				if (Utility::checkPrivilege($view, 'campaign', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/campaign/campaign/edit' class='report'>Campaign Edit</a></li>";               
                if (Utility::checkPrivilege($view, 'soldier', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/campaign/soldier/index' class='report'>Soldier</a></li>";
                if (Utility::checkPrivilege($view, 'typemap', 'index'))
                	$strList .= "<li><a href='$view->baseUrl/campaign/typemap/index' class='report'>Type map</a></li>";
                if (Utility::checkPrivilege($view, 'awardtype', 'index'))
                	$strList .= "<li><a href='$view->baseUrl/campaign/awardtype/index' class='report'>Award type</a></li>";
        		 if (Utility::checkPrivilege($view, 'export', 'index'))
                	$strList .= "<li><a href='$view->baseUrl/campaign/exportcamp/export' class='report'>Export</a></li>";
        }
        $strList .= "</ul>
					</div>
				</div>";
        echo $strList;
    }
}
?>
