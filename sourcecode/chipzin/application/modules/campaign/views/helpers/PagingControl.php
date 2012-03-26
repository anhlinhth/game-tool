<?php
class Zend_View_Helper_PagingControl
{
	public function pagingControl($itemPerpage, $curPage, $totalRecord, $view)
	{
		$totalPage = ceil($totalRecord/$itemPerpage);
		
		if($totalPage <= 1)
			$totalPage = 1;
		
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
		
		echo "Trang <a href='".htmlspecialchars($_SERVER['_SELF'])."?do=search&start=".$curPage."&page=".$prepage."'><img style='vertical-align: middle' src='$view->baseUrl/media/images/icons/arrow_left.gif' width='16' height='16'/> </a>";
				echo "<input size='1' value='$curPage' onkeypress='doPaging(event)' type='text' name='page' id='page' /> ";echo "/".$totalPage;
						 echo "<a href='".htmlspecialchars($_SERVER['_SELF'])."?do=search&start=".$curPage."&page=".$nextpage."'><img style='vertical-align: middle' src='$view->baseUrl/media/images/icons/arrow_right.gif' width='16' height='16'/> </a>";
					echo "trang | Hiển thị ";
		//echo "<li><a href='".htmlspecialchars($_SERVER['_SELF'])."?do=search&start=".$curPage."&page=".$prepage."'>Previous</a></li>";
		//echo "<li><a href='".htmlspecialchars($_SERVER['_SELF'])."?do=search&start=".$curPage."&page=".$nextpage."'>Next</a></li>";
		$strList .= "<select name='items' onchange='changeItems()'>";
		$itemInList = 10;
		$start		= 10;
		$step		= 10;
		
		for($i = 1; $i<=10;$i++)
		{
		  $value = $i*10;
          $selected = $itemPerpage == $value ? 'selected': '';
          $strList .= "<option $selected value='$value'>$value</option>";
		}
		
		$strList .= "</select> mẫu tin | Tổng cộng <strong>$totalRecord</strong> mẫu tin
		</div>";
		echo $strList;
	}
}
?>
