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
			
			case 'shop':
			case 'item':
			case 'itemshop':
			case 'download':			
			case 'export':
			case 'ibshop':
			case 'import':
			
            	if (Utility::checkPrivilege($view, 'shop', 'shop'))
                    $strList .= "<li><a href='$view->baseUrl/shop/shop/index' class='report'>Shop</a></li>";
                if (Utility::checkPrivilege($view, 'shop', 'ibshop'))
                    $strList .= "<li><a href='$view->baseUrl/shop/ibshop/index' class='report'>Ib Shop</a></li>";
                if (Utility::checkPrivilege($view, 'shop', 'itemshop'))
                    $strList .= "<li><a href='$view->baseUrl/shop/itemshop/index' class='report'>Item Shop</a></li>";
                    
				if (Utility::checkPrivilege($view, 'shop', 'item'))
                    $strList .= "<li><a href='$view->baseUrl/shop/item/index' class='report'>Item</a></li>";	
								 if (Utility::checkPrivilege($view, 'shop', 'inport'))
                   $strList .= "<li><a href='$view->baseUrl/shop/import/index' class='report'>Import</a></li>";
				if (Utility::checkPrivilege($view, 'shop', 'export'))
                    $strList .= "<li><a href='$view->baseUrl/shop/export/index' class='report'>Export</a></li>";  
                if (Utility::checkPrivilege($view, 'shop', 'download'))
                   $strList .= "<li><a href='$view->baseUrl/shop/download/index' class='report'>Download</a></li>";                              
					
                    break;
				
			
        }
        $strList .= "</ul>
					</div>
				</div>";
        echo $strList;
    }
}
?>
