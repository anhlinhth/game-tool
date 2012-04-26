<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_AwardType.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_AwardType.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_AwardType.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localite'.DS.'models'.DS.'Iefile.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localite'.DS.'models'.DS.'Group.php';

class Localite_IEFileController extends BaseController
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
		$model = new Models_Localite_Iefile();
		$filename = 'localization/vnm.xfz';
		if ($this->_request->isPost ()) 
		{
			$lang = $this->_request->getParam("llang");
			$filename = $this->_request->getParam("filename",$lang);			
			if($filename!='')			
			$model->WriteFile($model->GetAllContentByLang($lang), 'export/'.$filename.'.txt');
			else $this->view->errMsg="Phải đặt tên file export !";
		}
	}
	public function importAction(){	
		$model = new Models_Localite_Iefile();
		$filename = 'localization/vnm.xfz';
		if ($this->_request->isPost ()) {
			$lang = $this->_request->getParam("llang");
			$f = $_FILES['filename'];
			$file_temp = $f['tmp_name'];
			$filename = $f['name'];					
			$imgname = str_replace(' ', '-', $model->curentday().$filename);
			$fielpath =  ROOT_UPLOAD.'/localite/'.$imgname;
			if(move_uploaded_file($file_temp,$fielpath)){
				$array = $model->read_text_file($fielpath);
				$model->ImportFile($array,$lang);
				$this->view->msg = 'Import thành công!';
				unlink($fielpath);
			}
			else{
				$this->view->msg = 'Không tìm thấy file';
			}
		}
	}
}
