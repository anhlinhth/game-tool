<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Line.php';

class QuestLineController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	
	public function indexAction()
	{
	try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Line.php';
			$pageNo = $this->_request->getParam("page");
						
			$md = new Models_Quest_Line();
			
			$data = $md->_filter(NULL, "QuestLineID ASC");
			$count = $md->_count(null);			
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
				$id = $this->_request->getParam("QuestLineID");								
				$mdQuestLine = new Models_Quest_Line();
				$count=$mdQuestLine->isExistQuestLine($id);
				if($count!=0)				{
					echo "Bạn không thể xóa QuestLine này!!!Xóa Quest bên trong trước";
				}
				else{
					$mdQuestLine->_delete($id);
				}									
				Models_Log::insert($this->view->user->username, "act_delete_questline", $obj->name);
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
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Line.php';
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			$md = new Models_Quest_Line();
			if($this->_request->isPost())// da post du lieu len
				{
					$form= new Forms_Quest_Line();
					$form->_requestToForm($this);
					if($form->obj->QuestLineID != ""){
						$md->_update($form->obj);
						echo "update thanh cong";
					}else{ 
						$md->_insert($form->obj);
						echo "them thanh cong";
					}
				}
		}
		catch(Exception $ex)
	        {            
				$this->view->errMsg = $ex->getMessage();
				Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	        }			
	}}
?>
