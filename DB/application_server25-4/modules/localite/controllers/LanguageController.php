<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_AwardType.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_AwardType.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_AwardType.php';

require_once ROOT_APPLICATION.DS.'modules'.DS.'localite'.DS.'models'.DS.'Models_Language.php';


class Localite_LanguageController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','update','delete');
	}
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function indexAction(){
		$language = new Models_Language();
		if(isset($_REQUEST['status'])&&isset($_REQUEST['id']))
		{
			if($language->checkstatus('1')||$_REQUEST['status']==1)
			{
				$language->updatestatus($_REQUEST['id'],$_REQUEST['status']);
				$this->_redirect('/localite/language');
			}
			else 
				$this->view->errMsg = "Tối thiểu phải chọn một ngôn ngữ";
		}
		else
		if(isset($_REQUEST['id']))
		{
			if($language->checkdel($_REQUEST['id']))
				$language->DelById($_REQUEST['id']);
			else 
				$this->view->errMsg = "Cần phải xóa các bản dịch đối với ngôn ngữ này trước";
		}
		$this->view->data = $language->getDataLanguage();
	}
	public function insertAction()
	{
		$language = new Models_Language();
		if(isset($_REQUEST['id'])&&isset($_REQUEST['name']))
		{
			if($_REQUEST['id']==''||$_REQUEST['name']=='')
				$this->view->errMsg = "Xin vui lòng điền đầy đủ thông tin!";
			else
				if($language->checkId($_REQUEST['id']))
				{
					$language->insert($_REQUEST['id'], $_REQUEST['name']);
					$this->_redirect('/localite/language');
				}
				else 
					$this->view->errMsg = "Language này có thể đã có trong CSDL. Xin vui lòng kiểm tra lại!";
				
		}
		
	}
	public function updateAction()
	{
		$language = new Models_Language();
		if(!isset($_REQUEST['id'])||!isset($_REQUEST['name']))
			$this->_redirect('/localite/language');
		$this->view->id = $_REQUEST['id'];
		$this->view->name = $_REQUEST['name'];
		if(isset($_REQUEST['button']))
		{
			if($_REQUEST['name']=="")
				$this->view->errMsg = "Xin vui lòng điền đầy đủ thông tin!";
			else 
			{
				$language->update($_REQUEST['id'], $_REQUEST['name']);
				$this->_redirect('/localite/language');
			}
		}
	}
}
