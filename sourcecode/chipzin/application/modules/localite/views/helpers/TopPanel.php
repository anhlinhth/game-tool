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
			case 'language':
			case 'string':
			case 'string2':
			case 'lgroup':
			case 'iefile':
			case 'download':
            	if (Utility::checkPrivilege($view, 'localite', 'language'))
                    $strList .= "<li><a href='$view->baseUrl/localite/language/index' class='report'>Language Manager</a></li>";
				if (Utility::checkPrivilege($view, 'localite', 'string'))
                    $strList .= "<li><a href='$view->baseUrl/localite/string/index' class='report'>String Manage</a></li>";	
				if (Utility::checkPrivilege($view, 'localite', 'string'))
                    $strList .= "<li><a href='$view->baseUrl/localite/string2/index' class='report'>String Manage(fixed)</a></li>";
				 if (Utility::checkPrivilege($view, 'localite', 'language'))
                   $strList .= "<li><a href='$view->baseUrl/localite/string/insert' class='report'>Add String</a></li>";
				if (Utility::checkPrivilege($view, 'localite', 'lgroup'))
                    $strList .= "<li><a href='$view->baseUrl/localite/lgroup/index' class='report'>Group Manager</a></li>";
                
                if (Utility::checkPrivilege($view, 'localite', 'iefile'))
                    $strList .= "<li><a href='$view->baseUrl/localite/iefile/import' class='report'>Import</a></li>";
                    if (Utility::checkPrivilege($view, 'localite', 'iefile'))
                    $strList .= "<li><a href='$view->baseUrl/localite/iefile/index' class='report'>Export</a></li>";
                    if (Utility::checkPrivilege($view, 'localite', 'language'))
                    $strList .= "<li><a href='$view->baseUrl/localite/download/index' class='report'>Download file</a></li>";
					
                    break;
				
			
        }
        $strList .= "</ul>
					</div>
				</div>";
        echo $strList;
    }
}
?>
