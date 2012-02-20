<?php
class Zend_View_Helper_PagingControl
{
	public function pagingControl($itemPerpage, $curPage, $totalRecord, $view)
	{
		$totalPage = ceil($totalRecord/$itemPerpage);
		
		if($totalPage <= 1)
			return;
		
		if($curPage > 1)
			$previousLink = "javascript:goTo(". ($curPage - 1) .")";
		else
			$previousLink = "javascript:;";
		
		if($curPage < $totalPage)
			$nextLink = "javascript:goTo(". ($curPage + 1) .")";
		else
			$nextLink = "javascript:;";
		
		$strList .=	"<div id='pager'>
						Trang <a href='$previousLink'><img style='vertical-align: middle' src='$view->baseUrl/media/images/icons/arrow_left.gif' width='16' height='16' /></a>
						<input size='1' value='$curPage' onkeypress='doPaging(event)' type='text' name='page' id='page' /> 
						<a href='$nextLink'><img style='vertical-align: middle' src='$view->baseUrl/media/images/icons/arrow_right.gif' width='16' height='16' /></a>/ $totalPage trang | 
						Hiển thị ";
		
		$strList .= "<select name='items' onchange='changeItems()'>";
		$itemInList = 5;
		$start		= 10;
		$step		= 10;
		
		for($i = 0, $j = $start; $i < $itemInList; $i++, $j+=$step)
		{
			$selected = $itemPerpage == $j ? ' selected ' : ' ';
			$strList .= "<option $selected value='$j'>$j</option>";
		}
		
		$strList .= "</select> mẫu tin | Tổng cộng <strong>$totalRecord</strong> mẫu tin
		</div>";
		
		echo $strList;
	}
}
?>
