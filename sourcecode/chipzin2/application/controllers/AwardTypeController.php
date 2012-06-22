<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';
// require_once ROOT_APPLICATION_MODELS.DS.'Models_Gift_Package_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
// require_once ROOT_APPLICATION_MODELS.DS.'Models_Event.php';
// require_once ROOT_APPLICATION_MODELS.DS.'Models_SaleOff_Shop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Item_Increment.php';
// require_once ROOT_APPLICATION_MODELS.DS.'Models_Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_QAwardType.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Action_New.php';
// require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'PigManager.php';
// require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'ItemManager.php';
// require_once ROOT_APPLICATION_OBJECT.DS.'Obj_GiftPackage_Detail.php';
// require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Item.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Action.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Line.php';
require_once ROOT_APPLICATION_FORMS.DS.'Forms_QAwardType.php';
class AwardTypeController extends BaseController
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
		$md = new Models_QAwardType();
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
			if($this->_request->isPost())
			{				
				$id = $this->_request->getParam("ID");
				$md = new Models_QAwardType();
				try {
				$md->_deleteAwardType($id);
				}
				catch (Exception $e)
				{
					echo $e;
				}
				Models_Log::insert($this->view->user->username, "act_delete_AwardType", $obj->name);
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
			$md = new Models_QAwardType();
			if($this->_request->isPost())// da post du lieu len
				{
					$form= new Forms_QAwardType();
					$form->_requestToForm($this);
					if($md->isExistAwardType($form->obj->AwardTypeID)!=0){
						echo 1;
						$md->_update($form->obj);
						echo "Update th�nh c�ng";
					}else{ 
						$md->_insert($form->obj);
						echo "Th�m th�nh c�ng";
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
	///////get type d�ng cho quest
	public function getAction()
	{
		try
		{
			$md=new Models_Award_Type();
			$arraward = $md->getAwardtype();
			$arr = (array)$arraward;
			echo(json_encode($arr));
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
}
