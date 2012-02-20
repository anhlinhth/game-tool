<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

class ErrorController extends BaseController
{
	public function permissionAction()
	{
		$this->view->errMsg = "Bạn không có quyền truy cập vào trang này";
	}
}
?>
