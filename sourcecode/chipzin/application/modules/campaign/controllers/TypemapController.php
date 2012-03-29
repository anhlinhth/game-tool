<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Type.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Campaign.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Type.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_Type.php';

class Campaign_TypemapController extends BaseController
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
		$md = new Models_Type();
		$data = $md->getAllType();
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
			if($this->_request->isPost())
			{				
				$id = $this->_request->getParam("ID");
				$md = new Models_Campaign();
				if(($md->getType($id))==0)
				{					
				$mdType = new Models_Type();
				$mdType->_delete($id);									
				Models_Log::insert($this->view->user->username, "act_delete_Type", $obj->name);
				echo 1;	
				}
				else echo 2;
			}
		}
		catch(Exception $ex)
        {            
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}

public function updateAction(){
		try{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			$md = new Models_Type();
			if($this->_request->isPost())// da post du lieu len
				{
					$form= new Forms_Type();
					$form->_requestToForm($this);
					if($md->isExistType($form->obj->ID)!=0){
						echo 1;
						$md->_update($form->obj);
						echo "Update thành công";
					}else{ 
						$md->_insert($form->obj);
						echo "Thêm thành công";
					}
					Models_Log::insert($this->view->user->username, "act_update_Type", $obj->name);
				}
		}
		catch(Exception $ex)
	        {            
				$this->view->errMsg = $ex->getMessage();
				Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	        }			
	}

}

