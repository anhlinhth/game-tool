<?php
class Zend_View_Helper_Options
{
	public function options($data,$selected,$arrParram)
	{
		$strList .= "";
		if(isset($arrParram['default'])){
			$val = $arrParram['default'];
			$strList .= "<option value='$val'></option>";
		}	
		if(isset($arrParram['key']) && $data && isset($arrParram['name'])){
			$key = $arrParram['key'];
			$name = $arrParram['name'];
			
			
			foreach($data as $row)
				{
					$row = (array)$row;
					$name_id = empty($arrParram['flag'])?"":"[". $row[$key]."]";	
					if($row[$key] == $selected)
						$strSelect = 'selected';
					else
						$strSelect = '';
					$strList .= "<option $strSelect value=$row[$key]>$row[$name]$name_id</option>";
				}
		}	
		echo $strList;
	}
}
?>
