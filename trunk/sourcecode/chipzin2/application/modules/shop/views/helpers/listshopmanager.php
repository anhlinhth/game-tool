<?php
class Zend_View_Helper_listshopmanager
{
	public function listshopmanager($data)
	{
		$strList .= "";
		if(!$data) return;
		foreach ($data as $key=>$row)
		{
			$edit = "";
			$delete = "";
			
			$edit = "<a class='tool-16 edit' href='javascript:viewItemShop($row->IDSI)'></a>";
			$delete = "<a class='tool-16 delete' href='javascript:deleteItemShop($row->IDSI)'></a>";
			$strList .= "<tr>
							<td style='width: 35px'><input type='text' style='width: 30px;border: none;' readonly name='shop_itemID$row->IDSI' value='$row->IDSI'></td>
							<td>
								<input type='text' readonly style='width: 80%;border: none;'name='Name$row->IDSI' value='$row->Name'>
								<input type='hidden' name='itemshopID$row->IDSI' value='$row->ID'>
							</td>
							<td align='center'>$edit&nbsp$delete&nbsp</td></tr>";
		}
		echo $strList;
	}
}
?>
