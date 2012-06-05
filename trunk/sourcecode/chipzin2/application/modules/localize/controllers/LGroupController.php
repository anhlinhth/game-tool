<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_AwardType.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_AwardType.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_AwardType.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localize'.DS.'models'.DS.'Language.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localize'.DS.'models'.DS.'Group.php';

class Localize_LGroupController extends BaseController
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
		$model = new Models_Localize_Group();		
		if ($this->_request->getParam("msg"))
			$this->view->msg = $this->_request->getParam("msg");	
		if ($this->_request->isPost ()) {
			if($this->view->msg == $this->_request->getParam("btdelete")){
				foreach ( $model->GetAllGroup() as $value) {
					if($this->_request->getParam($value['id'])){
						$model->deleteGroup($value['id']);
					}
				}
			}
			if($this->_request->getParam("btsave")){
				foreach ( $model->GetAllGroup() as $value) {
					if($this->_request->getParam($value['id'])){
						$this->_redirect('/localize/lgroup/ledit?id='.$value['id']);
					}
				}
			}
		}	
	}
	public function laddAction(){	
		$model = new Models_Localize_Group();
		if ($this->_request->isPost ()) {
			$name = $this->_request->getParam("name");
			if($name){
				if($model->CheckExistGroup($name) == false){
					$result = $model->InsertGroup($name);	
					$this->_redirect('/localize/lgroup');
				}	
				else $this->view->msg = 'Nhóm này đã tồn tại vui lòng nhập tên khác';
			}
			else  $this->view->msg = 'Vui lòng nhập tên nhóm';
		}
	}
	public function leditAction(){	
		$model = new Models_Localize_Group();
		$id = $this->_request->getParam("id",'');
		$this->view->id = $id;
		if ($this->_request->isPost ()) {
			$name = $this->_request->getParam("name");
			if($name){
				$result = $model->UpdateGroup($id, $name);	
				$this->_redirect('/localize/lgroup');		
			}	
			else  $this->view->msg = 'Vui lòng nhập tên nhóm';		
		}
	}
	public function ldeleteAction(){	
		$this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
		$model = new Models_Localize_Group();
		$id = $this->_request->getParam("id");
		if($id){
			if($model->CheckExistGroupById($id)){
				$model->deleteGroup($id);
				$this->_redirect('/localize/lgroup');
			}
			else $this->_redirect('/localize/lgroup?msg=Nhóm không tồn tại');	
		}
		else 
			$this->_redirect('/localize/lgroup?msg=Nhóm không tồn tại');	
	}
	public function getgroupnameAction(){	
		$this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
		$model = new Models_Localize_Group();
		$id = $this->_request->getParam("id");
		$info = $model->GetGroupInfo($id);
		echo $info['name'];
	}
}
