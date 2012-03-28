<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_AwardType.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_AwardType.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_AwardType.php';

class Campaign_AwardTypeController extends BaseController
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
	try
	{
		$md = new Models_AwardType();
		$data = $md->getAllAwardType();
		$this->view->data = $data;
		
		
	}
	catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}	
	}
public function deleteAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			$id = $this->_request->getParam("id");
			$md = new Models_AwardType();
			$md->_deleteAwardType($id);
			$result = array('msg' => '1', 'AwardTypeID' => $id);
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			$result = array('msg' => $ex->getMessage(), 'AwardTypeID' => "");
            echo json_encode($result); 
            echo $ex;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}

public function updateAction(){
		try{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			$md = new Models_AwardType();
			if($this->_request->isPost())// da post du lieu len
				{
					$form= new Forms_AwardType();
					$form->_requestToForm($this);
					if($md->isExistAwardType($form->obj->AwardTypeID)!=0){
						echo 1;
						$md->_update($form->obj);
						echo "Update thành công";
					}else{ 
						$md->_insert($form->obj);
						echo "Thêm thành công";
					}
					Models_Log::insert($this->view->user->username, "act_update_AwardType", $obj->name);
				}
		}
		catch(Exception $ex)
	        {            
				$this->view->errMsg = $ex->getMessage();
				Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	        }			
	}

}
