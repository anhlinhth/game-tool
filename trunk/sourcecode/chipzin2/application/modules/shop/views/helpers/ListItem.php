<?php
class Zend_View_Helper_ListItem
{
	public function listItem($data,$arritem)
	{
		if(!$data)
			return;
		$strList = "";
		$delete = '&nbsp&nbsp<a class="tool-16 delete" href="" title="Delete Item"></a><br>';
		$select = '';
		$search = '<a class="tool-16 search" href=""></a>';
		foreach ($data as $row)
		{
			$select = '<select class="itemshopold" name="itemshopID[]" id="itemshop_'.$row->ID.'">';
			foreach($arritem as $item)
			{
				if($item->E == "")
					$name = $item->Item;
				else
					$name = $item->E;
				if($item->I == $row->itemshopID)
					$selected = 'selected';
				else
					$selected = '';
				$select .= '<option '.$selected.' value="'.$item->I.'">'.$name.' (itemshopID ='.$item->I.')</option>';
			}
			$select .= "</select>";
			$strList .= '<div id="'.$row->ID.'">';
			$strList .= '&nbsp&nbsp'.$select;
			$strList .= '&nbsp&nbsp'.$search.'&nbsp'.$delete;
			$strList .= '</div>';
		}		
		echo $strList;
	}

}
?>
