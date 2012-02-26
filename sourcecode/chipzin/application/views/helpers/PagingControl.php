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
			$prepage=max($curPage - 1,1);
		
		if($curPage < $totalPage)
			$nextLink = "javascript:goTo(". ($curPage + 1) .")";
		else
			$nextLink = "javascript:;";
			$nextpage=min($totalPage,$curPage+1);
		
		echo "Trang <a href='".htmlspecialchars($_SERVER['_SELF'])."?do=search&start=".$curPage."&page=".$prepage."'> Previous </a>";
				echo "<input size='1' value='$curPage' onkeypress='doPaging(event)' type='text' name='page' id='page' /> ";echo "/".$totalPage;
						 echo "<a href='".htmlspecialchars($_SERVER['_SELF'])."?do=search&start=".$curPage."&page=".$nextpage."'> Next </a>";
					echo "trang | Hiển thị ";
		//echo "<li><a href='".htmlspecialchars($_SERVER['_SELF'])."?do=search&start=".$curPage."&page=".$prepage."'>Previous</a></li>";
		//echo "<li><a href='".htmlspecialchars($_SERVER['_SELF'])."?do=search&start=".$curPage."&page=".$nextpage."'>Next</a></li>";
		$strList .= "<select name='items' onchange='changeItems()' >";
		$itemInList = 5;
		$start		= 10;
		$step		= 10;
		
		for($i = 0, $j = $start; $i < $totalPage; $i++, $j+=$step)
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
