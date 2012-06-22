<?php
require_once ROOT_APPLICATION_CONTROLLERS . DS . 'BaseController.php';
require_once ROOT_LIBRARY_UTILITY . DS . 'utility.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Log.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_import.php';
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'campaign' . DS . 'models' . DS . 'Models_C_import_logic.php';

class Campaign_ItemController extends BaseController {
	public function _setUserPrivileges() {
		return array ('index' );
	}
	
	public function preDispatch() {
		parent::preDispatch ();
		
		if (! $this->hasPrivilege ())
			$this->_redirect ( "/error/permission" );
	}
	public function indexAction()
	{
		
	}
}
?>