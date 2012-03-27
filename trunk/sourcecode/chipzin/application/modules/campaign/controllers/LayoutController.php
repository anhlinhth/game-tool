<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Layout.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Layout.php';
class Campaign_LayoutController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function insertAction()
	{
		try{
		    $this->_helper->layout->disableLayout();
		    $this->_helper->viewRenderer->setNorender();
		    $obj = new Obj_Layout();		    
		    $obj->Name = $_POST['name'];
		    $obj->Point = $_POST['point'];
		    $md = new Models_Layout();
		    $id =  $md->_insert($obj);
		    $result = array('msg' => '1', 'LayoutID' => $id);
		    echo json_encode($result);
		}
	    catch (exception $ex) {
	    	$this->view->errMsg = $ex->getMessage();
	    	$result = array('msg' => $ex->getMessage(), 'CampID' => "");
	    	echo json_encode($result);
	    	Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	    }
		
			
	}
}


