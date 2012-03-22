<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'models'.DS.'Models_Map_Package.php';
class Campaign_ExportController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','active','item','additem','pigshop','itemshop','export');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	
	
	public function exportAction()
	{
		$model = new Models_Map_Package();
		$tuo = new Models_Map_Package();
		$data = $tuo->getdata();
		$questIdError = $model->generate($data);
		
		if(!empty($questIdError)){
			//$this->view->val = 1;
			$this->view->questIdError = $questIdError;	
		}else{

		}

	}
	public function downloadAction()
	{
	}
	public function indexAction()
	{
		echo "Heloo";
	}
	

}
?>
