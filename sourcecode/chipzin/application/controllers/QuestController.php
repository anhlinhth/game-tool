<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Detail.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Detail.php';


class QuestController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','active','item','additem','pigshop','itemshop');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	
	public function indexAction()
	{
				
	}	
	
	public function editAction()
	{		
		try
		{
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Quest_Detail.php';			
			
			$md = new Models_Quest_Detail();
			
			if($this->_request->isPost())// da post du lieu len
			{
				
			}
			else{		// chua post du lieu-->load du lieu vao Form		
				$id = $this->_request->getParam("id");
				$this->view->form = $md->_getByKey($id);
				$this->view->arr = $md->getQuestLine();
			}
			
		}
		catch(Exception $ex)
        {
            $this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
		
	}
	
	public function listquestAction()
	{
				
	}
	
	
}
?>
