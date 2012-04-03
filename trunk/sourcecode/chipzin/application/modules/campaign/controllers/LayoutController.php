<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_Layout.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Layout.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
class Campaign_LayoutController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function insertAction()
	{
		try{
		    $this->_helper->layout->disableLayout();
		    $this->_helper->viewRenderer->setNorender();
		    $obj = new Obj_Layout();		    
		    $obj->Name = $_POST['name'];
		    $obj->Point = $_POST['point'];
		    $md = new Models_Layout();
		    $id =  $md->_insert($obj);
		    $result = array('msg' => '1', 'LayoutID' => $id);
		    echo json_encode($result);
		}
	    catch (exception $ex) {
	    	$this->view->errMsg = $ex->getMessage();
	    	$result = array('msg' => $ex->getMessage(), 'LayoutID' => "");
	    	echo json_encode($result);
	    	Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
	    }
		
			
	}
	public function indexAction()
	{
		try
		{
			require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_Layout.php';
			$pageNo = $this->_request->getParam("page");
			$items = $this->_request->getParam("items");
			$form = new Forms_Layout();
			$form->_requestToForm($this);
			$md = new Models_Layout();
			$searchID=$this->_request->getParam('searchID');
			$data = $md->filter($searchID, "ID ASC",($pageNo - 1)*$items, $items);
			$count = $md->_count($form->obj);
			
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
	public function deleteAction()
	{
		try
		{
			require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'models' .
						DS . 'Models_Campaign.php';
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			if($this->_request->isPost())
			{
				$id = $this->_request->getParam("ID");
				$mdLayout = new Models_Layout();
				$md = new Models_Campaign();
				$arrcampaign = $md->getCampaignByLayout($id);				
				if(empty($arrcampaign)){
					$return = $mdLayout->delete($id);
				}
				echo(json_encode($arrcampaign));				
				Models_Log::insert($this->view->user->username, "act_delete_Layout");
				
			}
		}
		catch(Exception $ex)
		{			
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	public function updateAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			if($this->_request->isPost())
			{
				$id = $_POST['ID'];
				$Point = $_POST['point'];
				$Name = $_POST['Name'];
				$mdLayout = new Models_Layout();
				$obj = new Obj_Layout();
				$mdLayout->update($id,$Point,$Name);
				echo 1;
			}
		}
		catch(Exception $ex)
		{
			echo $ex;
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
}


