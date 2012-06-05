<?php
class Zend_View_Helper_ListPrivileges
{
	public function listPrivileges($privileges,$groupPrivileges,$view)
	{
		if(!$privileges)
			return;
		
		$strList .= "<table style='width: 30%'>";
		foreach($privileges as $controllerName => $controllerPrivilege)
		{
			$flag = 0;
			foreach($controllerPrivilege as $privilege)
			{
				if($groupPrivileges[$privilege->id])
					$flag++;
			}
			
			if($flag == count($controllerPrivilege))
				$checkAll = 'checked';
			else
				$checkAll = '';
			
			$strList .= "<tr>
							<td id='tdImg$controllerName'>
								<img id='imgOpen$controllerName' onclick='openPrivilege(\"$controllerName\")' style='vertical-align: middle; cursor:pointer' src='$view->baseUrl/media/images/icons/arrow-off.gif'/>								
								{$view->langData->_($controllerName)}</td>
							<td align='center'><input $checkAll id='chkAll$controllerName' style='margin-bottom: 0px' type='checkbox' onclick='checkAll(this,\"$controllerName\")'/></td>
						</tr>";
			
			foreach($controllerPrivilege as $privilege)
			{
				if($groupPrivileges[$privilege->id])
					$checked = "checked";
				else
					$checked = "";
				$strList .= "<tr id='{$controllerName}_{$privilege->action_name}' style='display:none'>
								<td style='padding-left: 40px;'>{$view->langData->_($privilege->action_name)}</td>
								<td align='center'><input $checked class='chk$controllerName' style='margin-bottom: 0px' type='checkbox' name='chk$privilege->id' value='1' onclick='checkItem(\"$controllerName\")'/></td>
							</tr>";
			}
			
			$strList .= "<tr style='height:20px'><td colspan='2'></td></tr>";
		}		
		
		$strList .= "</table>";
		
		echo $strList;
	}
}
?>
