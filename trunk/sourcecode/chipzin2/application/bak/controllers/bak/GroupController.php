<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_LIBRARY_UTILITY.DS.'ControllerFactory.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Group.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Privilege.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Group_Privilege.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

class GroupController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','delete','privilege');
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
			
			$md = new Models_Group();
			$data = $md->_filter(null, "id DESC", ($pageNo - 1)*$items, $items);
			$count = $md->_count(null);
			
			
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
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Group.php';
			
			if($this->_request->isPost())
			{
				$form = new Forms_Group();
				$form->_requestToForm($this);
				$form->validate(INSERT);
				
				$md = new Models_Group();				
				$md->_insert($form->obj);
				
				Models_Log::insert($this->view->user->username, "act_add_group");
				$this->_redirect("/group/index");
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
			require_once ROOT_APPLICATION_FORMS.DS.'Forms_Group.php';
			
			$md = new Models_Group();
			
			if($this->_request->isPost())
			{
				$form = new Forms_Group();
				$form->_requestToForm($this);
				$form->validate(UPDATE);
				
				$md->_update($form->obj);
				
				Models_Log::insert($this->view->user->username, "act_edit_group");
				$this->_redirect("/group/index");
			}
			else
			{
				$id = $this->_request->getParam("id");
				if($id == 1)
					$this->_redirect ("/error/permission");
				
				$obj = $md->_getByKey($id);
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
				$md= new Models_Group();
				$md->_delete($id);		
				
				Models_Log::insert($this->view->user->username, "act_delete_group");
			}
		}
		catch(Exception $ex)
		{				
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	public function privilegeAction()
	{
		try
		{
			Utility::getLanguage($this);			
			
			$groupId = $this->_request->getParam("id");
			if($groupId == 1)
				$this->_redirect ("/error/permission");
			
			$mdGroup = new Models_Group();
			$group = $mdGroup->_getByKey($groupId);
			$this->view->group = $group;

			$this->_updatePrivilegesTable();
			$mdPrivilege = new Models_Privilege();

			//Get Privileges
			$privileges = array();
			$controllerNames = Utility::getControllerNames();
			$size = count($controllerNames);
			for($i = 0; $i < $size; $i++)
			{
				$controllerNames[$i] = strtolower(substr($controllerNames[$i], 0, strlen($controllerNames[$i]) - 10));
			}	

			foreach($controllerNames as $controllerName)
			{
				$privileges[$controllerName] = $mdPrivilege->getPrivilegeByController($controllerName);
				$controllerList .= "$controllerName,";
			}

			$this->view->privileges = $privileges;
			$this->view->controllerList = $controllerList;			
				
			if($this->_request->isPost())
			{				
				$this->_updateGroupPrivilege($privileges, $groupId);
				$this->view->msg = "Lưu thành công";
				Models_Log::insert($this->view->user->username, "act_privilege");
			}		
			
			$groupPrivileges = array();
			$this->_getGroupPrivilege($groupPrivileges, $privileges, $groupId);
			$this->view->groupPrivileges = $groupPrivileges;
		}
		catch(Exception $ex)
		{		
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	private function _updatePrivilegesTable()
	{
		try
		{
			$mdPrivilege = new Models_Privilege();
			
			$controllerNames = Utility::getControllerNames();
			foreach($controllerNames as $controllerName)
			{
				$controller = ControllerFactory::getController($controllerName, $this->_request, $this->_response);
				$actionNames = $controller->_setUserPrivileges();
				
				if(!$actionNames)
					continue;
				
				$controllerName = strtolower(substr($controllerName, 0, strlen($controllerName) - 10));
				
				foreach($actionNames as $actionName)
				{
					$privilege = $mdPrivilege->getPrivilegeByControllerAndAction($controllerName, $actionName);
					if($privilege)
						continue;
					
					$privilege = new Obj_Privilege();
					$privilege->action_name = $actionName;
					$privilege->controller_name = $controllerName;
					
					$mdPrivilege->_insert($privilege);
				}
				
				//Delete privilege is not exist
				$privileges = $mdPrivilege->getPrivilegeByController($controllerName);
				if(!$privileges)
					continue;				
				
				foreach($privileges as $privilege)
				{
					if(!in_array($privilege->action_name, $actionNames))					
						$mdPrivilege->_delete($privilege->id);					
				}
			}
		}
		catch(Exception $ex)
		{				
			throw $ex;
		}
	}
	
	private function _updateGroupPrivilege($privileges,$groupId)
	{
		$mdGroupPrivilege = new Models_Group_Privilege();
		
		foreach($privileges as $controllerPriviles)
		{
			foreach($controllerPriviles as $privilege)
			{
				$check = $this->_request->getParam("chk$privilege->id");
				$groupPrivilege = $mdGroupPrivilege->getGroupPrivilege($groupId, $privilege->id);
				if(!$groupPrivilege)
				{
					$obj = new Obj_Group_Privilege();
					$obj->group_id = $groupId;
					$obj->privilege_id = $privilege->id;
					$obj->status = (int)$check;
					
					$mdGroupPrivilege->_insert($obj);
				}
				else
				{
					$groupPrivilege->status = (int)$check;
					$mdGroupPrivilege->_update($groupPrivilege);
				}
			}
		}
	}
	
	private function _getGroupPrivilege(&$groupPrivileges,$privileges,$groupId)
	{
		$mdGroupPrivilege = new Models_Group_Privilege();
		
		foreach($privileges as $controllerPriviles)
		{
			foreach($controllerPriviles as $privilege)
			{
				$obj = $mdGroupPrivilege->getGroupPrivilege($groupId, $privilege->id);				
				$groupPrivileges[$privilege->id] = (int)$obj->status;
			}
		}
	}
}
?>
