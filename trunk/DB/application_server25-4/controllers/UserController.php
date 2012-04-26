<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_User.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Group.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_FORMS.DS.'Forms_User.php';

class UserController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','log');
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
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$mdUser = new Models_User();
			$data = $mdUser->_filter(null, "created_date DESC", ($pageNo - 1)*$items, $items);
			$count = $mdUser->_count(null);			
			
			$this->view->data = $data;
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	public function addAction()
	{
		try
		{
			$arrGroup = $this->_getGroup();
			$this->view->groups = $arrGroup;
			
			if($this->_request->isPost())
			{
				$form = new Forms_User();
				$form->requestToForm($this);
				$form->validate(INSERT);
				
				$mdUser = new Models_User();				
				$form->obj->password = md5($form->obj->password);
				unset ($form->obj->password2);
				$form->obj->created_date = date("Y-m-d H:i:s");
				$mdUser->insert($form->obj);
				
				Models_Log::insert($this->view->user->username, "act_adduser");
				$this->_redirect("/user/index");
			}
		}
		catch(Exception $ex)
		{
			$this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	public function editAction()
	{
		try
		{
			$arrGroup = $this->_getGroup();
			$this->view->groups = $arrGroup;
			
			$mdUser = new Models_User();
			
			if($this->_request->isPost())
			{
				$form = new Forms_User();
				$form->requestToForm($this);
				$form->validate(UPDATE);
				
				if($form->obj->password)			
					$form->obj->password = md5($form->obj->password);				
				else			
					unset ($form->obj->password);	
				
				unset ($form->obj->password2);				
				unset ($form->obj->username);
				
				$mdUser->_update($form->obj);
				
				Models_Log::insert($this->view->user->username, "act_edituser");
				$this->_redirect("/user/index");
			}
			else
			{
				$id = $this->_request->getParam("id");
				$obj = $mdUser->_getByKey($id);
				$this->view->form = $obj;
			}
		}
		catch(Exception $ex)
		{
			$this->view->form = $form->obj;
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
				$id = $this->_request->getParam("id");
				$mdUser = new Models_User();
				$mdUser->_delete($id);
				
				Models_Log::insert($this->view->user->username, "act_deleteuser");
			}
		}
		catch(Exception $ex)
		{			
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	public function logAction()
	{
		try
		{
			Utility::getLanguage($this);
			
			$formIndex->txtUsername = $this->_request->getParam("txtUsername");
			$formIndex->txtDate		= $this->_request->getParam("txtDate");
			
			
			
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			
			if($pageNo == 0)
				$pageNo = 1;
			if($items == 0)
				$items = DEFAULT_ITEM_PER_PAGE;
			
			$md = new Models_Log();
			$objSearch->user = $formIndex->txtUsername;
			if($formIndex->txtDate)
			{
				$arrDate = explode("/", $formIndex->txtDate);
				$date = $arrDate[2]."-".$arrDate[0]."-".$arrDate[1];
			}
			$objSearch->action_date = $date;
			$data = $md->filter($objSearch, "action_date DESC", ($pageNo - 1)*$items, $items);
			$count = $md->count($objSearch);
			
			$this->view->data = $data;
			$this->view->items = $items;
			$this->view->page = $pageNo;
			$this->view->totalRecord = $count;
			$this->view->formIndex = $formIndex;
		}
		catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	private function _getGroup()
	{
		$mdGroup = new Models_Group();
		$groups = $mdGroup->getGroup();
		$arrGroup = array();
		if($groups)
		{
			foreach($groups as $group)
			{
				$arrGroup[] = array(
					'id'	=> $group->id,
					'name'	=> $group->name
				);
			}
		}
		
		return $arrGroup;
	}
}
?>
