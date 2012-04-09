<?php
class Zend_View_Helper_ShowHello
{
	public function showHello($user, $view)
	{
		if(!$user)
			return;
		
		$strList .= "<div class='hello'>
						Xin chào <span style='color:red;'>$user->fullname</span> | 
						<a href='$view->baseUrl/auth/changepassword'>Đổi mật khẩu</a> | 
						<a href='$view->baseUrl/auth/logout'>Thoát</a>
					</div>";
		
		echo $strList;
	}
}
?>
