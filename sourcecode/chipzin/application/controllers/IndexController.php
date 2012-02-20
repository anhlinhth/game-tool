<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

class IndexController extends BaseController
{
	public function indexAction()
	{
		 $this->_redirect ("/quest");
	}
}
?>
