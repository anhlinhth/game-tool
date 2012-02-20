<?php
class Zend_View_Helper_TopPanel
{
	public function topPanel($controllerName,$view)
	{
		if($controllerName == 'auth' || $controllerName == 'error')
			return;
           
		$strList .= "<div id='top-panel'>
						 <div id='panel'>";
		$strList .= "<ul>";
		switch($controllerName)
		{
			case 'user':
				if(Utility::checkPrivilege($view, 'user', 'index'))
					$strList .= "<li><a href='$view->baseUrl/user/index' class='report'>Danh sách</a></li>";
				if(Utility::checkPrivilege($view, 'user', 'add'))
					$strList .= "<li><a href='$view->baseUrl/user/add' class='useradd'>Thêm người dùng</a></li>";
				if(Utility::checkPrivilege($view, 'user', 'log'))
					$strList .= "<li><a href='$view->baseUrl/user/log' class='search'>Theo dõi</a></li>";
				break;
			case 'tool':
				if(Utility::checkPrivilege($view, 'tool', 'notice'))
					$strList .= "<li><a href='$view->baseUrl/tool/notice' class='feed'>Thông báo</a></li>";
				if(Utility::checkPrivilege($view, 'tool', 'compensation'))
					$strList .= "<li><a href='$view->baseUrl/tool/compensation' class='promotions'>Đền bù</a></li>";
                if(Utility::checkPrivilege($view, 'tool', 'popup'))
                    $strList .= "<li><a href='$view->baseUrl/tool/popup' class='popup'>Popup</a></li>";				
                if(Utility::checkPrivilege($view, 'tool', 'compensationplayer'))
                    $strList .= "<li><a href='$view->baseUrl/tool/compensationplayer' class='compensationplayer'>Đền bù player</a></li>";                
                if(Utility::checkPrivilege($view, 'tool', 'reason'))
                    $strList .= "<li><a href='$view->baseUrl/tool/reason' class='denbu'>Lý do [New]</a></li>";
                if(Utility::checkPrivilege($view, 'tool', 'denbu'))
                    $strList .= "<li><a href='$view->baseUrl/tool/denbu' class='denbu'>Đền bù [New]</a></li>";                
                if(Utility::checkPrivilege($view, 'tool', 'approve'))
                    $strList .= "<li><a href='$view->baseUrl/tool/approve' class='approve'>Duyệt đền bù</a></li>";
                if(Utility::checkPrivilege($view, 'tool', 'statistic'))
                    $strList .= "<li><a href='$view->baseUrl/tool/statistic' class='statistic'>Thống kê đền bù</a></li>";
				break;
			case 'group':
				if(Utility::checkPrivilege($view, 'group', 'index'))
					$strList .= "<li><a href='$view->baseUrl/group/index' class='report'>Danh sách</a></li>";
				if(Utility::checkPrivilege($view, 'group', 'add'))
					$strList .= "<li><a href='$view->baseUrl/group/add' class='add'>Thêm nhóm</a></li>";
				break;
            case 'shopeditor':
                if(Utility::checkPrivilege($view, 'shopeditor', 'pig'))
                    $strList .= "<li><a href='$view->baseUrl/shopeditor/pig' class='pig'>Pig Editor</a></li>";
                if(Utility::checkPrivilege($view, 'shopeditor', 'item'))
                    $strList .= "<li><a href='$view->baseUrl/shopeditor/item' class='item'>Item Editor</a></li>";
				if(Utility::checkPrivilege($view, 'shopeditor', 'itemmanager'))
                    $strList .= "<li><a href='$view->baseUrl/shopeditor/itemmanager' class='item'>Item Editor (new)</a></li>";
				if(Utility::checkPrivilege($view, 'shopeditor', 'getitemid'))
                    $strList .= "<li><a href='$view->baseUrl/shopeditor/getitemid'>Lấy Item Id</a></li>";
                break;
			case 'event':
				if(Utility::checkPrivilege($view, 'event', 'goldexp'))
					$strList .= "<li><a href='$view->baseUrl/event/goldexp' class='promotions'>Vàng-Exp</a></li>";				
				if(Utility::checkPrivilege($view, 'event', 'namthien'))
					$strList .= "<li><a href='$view->baseUrl/event/namthien' class='kim_in_lenh'>Nam Thiên</a></li>";
                if(Utility::checkPrivilege($view, 'event', 'dsevent'))
                    $strList .= "<li><a href='$view->baseUrl/event/dsevent' class='kim_in_lenh'>DS Event [New]</a></li>";
				break;	
			case 'gift':
				if(Utility::checkPrivilege($view, 'gift', 'index'))
					$strList .= "<li><a href='$view->baseUrl/gift/index' class='report'>Danh sách</a></li>";
				if(Utility::checkPrivilege($view, 'gift', 'add'))
					$strList .= "<li><a href='$view->baseUrl/gift/add' class='add'>Thêm gói phần thưởng</a></li>";
				break;
            case 'ibshop':
                if(Utility::checkPrivilege($view, 'ibshop', 'index'))
                    $strList .= "<li><a href='$view->baseUrl/ibshop/index' class='report'>Danh sách</a></li>";
                if(Utility::checkPrivilege($view, 'ibshop', 'position'))
                    $strList .= "<li><a href='$view->baseUrl/ibshop/arrange' class='report'>Sắp xếp shop</a></li>";
                break;
                
            case 'quest':
				if(Utility::checkPrivilege($view, 'quest', 'questline'))
					$strList .= "<li><a href='$view->baseUrl/quest/questline' class='report'>Quest Line</a></li>";
				if(Utility::checkPrivilege($view, 'quest', 'listquest'))
					$strList .= "<li><a href='$view->baseUrl/quest/listquest' class='report'>Quest</a></li>";
				  
		}	
		
		$strList .= "</ul>
					</div>
				</div>";
		
		echo $strList;
	}
}
?>
