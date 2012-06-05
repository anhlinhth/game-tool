<?php

require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localize'.DS.'models'.DS.'Models_String2.php';


class Localize_String2Controller extends BaseController
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
	public function indexAction()
	{
		try{
			$todo 		= $this->_request->getParam("todo");
			$searchtype = $this->_request->getParam("searchtype");
			$searchbox 	= $this->_request->getParam("searchbox");
			$search 	= $this->_request->getParam("searchbox");
			$page 		= $this->_request->getParam("page",'1');
			$size 		= $this->_request->getParam("size");
			$group 		= $this->_request->getParam("group");
			$ldefault 	= $this->_request->getParam("ldefault");
			$lindex 	= $this->_request->getParam("lindex");
			$llanguage 	= $this->_request->getParam("l_language");
			$md_string 	= new Models_String2();
			$content_item = new Obj_Base();	
			
			if($page==0)
				$page = 1;						
			
			if($searchtype == "stext")
				$content_item ->text = $searchbox;
			if($searchtype == "skey")
				$content_item->lkey = $searchbox;
			if($group){
				unset($_SESSION['lgroup']);
				$_SESSION['lgroup'] = $group;
				$content_item->lgroup = $group;					
			}else if (isset($_SESSION["lgroup"])){
				$content_item->lgroup = $_SESSION["lgroup"];	
			}
			if(isset($ldefault) && !empty($ldefault)){
				$content_item->ldefault = $ldefault;			
			}			
			if(isset($lindex) && !empty($lindex)){
				$content_item->lindex = $lindex;			
			}
			if(isset($llanguage) && !empty($llanguage)){
				$md_string->updateindexlang2($llanguage);			
			}
			$arr_string = $md_string->filter2($content_item,$page,$size);
			$count = $md_string->getCount2($content_item);

			if($todo == "ajax"){
				$this->_helper->layout->disableLayout();
				$this->_helper->viewRenderer->setNorender();				
				$rs = Array("num"=>$count/$size,'data'=>$arr_string);
				var_dump($rs);
				echo json_encode($rs);				
			}else{
				$arr_group = $md_string->getAllGroup2();
				$max_key = 	$md_string->getMaxKeyOfGroup($content_item->lgroup);
				$arr_lang = $md_string->getlanguage2();	
				$index_lang = $md_string->getlangindex2();					
				$this->view->page = $page;
				$this->view->size = $size;
				$this->view->arr_string = $arr_string;
				$this->view->item = $content_item;
				$this->view->searchtype = $searchtype;
				$this->view->searchbox = $searchbox;
				$this->view->max_key = $max_key + 1;
				$this->view->arr_lang = $arr_lang;
				$this->view->index_lang = $index_lang;
				$this->view->num = $count/$size;
				$this->view->arr_group = $arr_group;
			}			
		}catch(Exception $ex){
		    $this->view->errMsg = $ex->getMessage();
		}
	}
	public function insertAction()
	{
		
	    try{	
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			
			$content_item = new Obj_Base();
			$content_item->lindex = htmlspecialchars($_POST['lindex'],ENT_QUOTES);
			$content_item->ldefault = htmlspecialchars($_POST['ldefault'],ENT_QUOTES);
			if(empty($_POST['ldefault']))
				$content_item->ldefault = null;
			if(empty($_POST['lindex']))
				$content_item->lindex = null;
			if(isset($_POST['lkey']) && !empty($_POST['lkey']))
				$content_item->lkey = $_POST['lkey'];
			if(isset($_POST['lgroup']) && !empty($_POST['lgroup']))
				$content_item->lgroup = $_POST['lgroup'];	
			$md_string = new Models_String2();					
			
			$id_inserted = $md_string->insert2($content_item);
			if($id_inserted!=0){
				$content_item->id = $id_inserted;
				$content_item->max_key = $md_string->getMaxKeyOfGroup($content_item->lgroup);			
				echo json_encode((Array)$content_item);
			}else{
				return null;
			}
	       
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
		
	}
	
	public function updateAction()
	{
		 try{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();			
			$content_item = new Obj_Base();
			$error = "";
			if(isset($_POST['lgroup']) && !empty($_POST['lgroup']))
				$content_item->lgroup = $_POST['lgroup'];
			else $error = "lgroup is null";
			
			if(isset($_POST['lkey']) && !empty($_POST['lkey']))
				$content_item->lkey = $_POST['lkey'];
			else $error = "lkey is null";
			
			if(isset($_POST['ldefault']) && !empty($_POST['ldefault']))
				$content_item->ldefault = $_POST['ldefault'];
			if(isset($_POST['lindex']) && !empty($_POST['lindex']))
				$content_item->lindex = $_POST['lindex'];
				
			if($error != ""){
				echo $error; return;	
			}
				
			$md_string = new Models_String2();
			$count =  $md_string->update2($content_item);
			echo "true";					
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	
	}
	
	public function deleteAction()
	{			
	    try{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();			
			$content_item = new Obj_Base();
			$error = "";
			if(isset($_POST['lgroup']) && !empty($_POST['lgroup']))
				$content_item->lgroup = $_POST['lgroup'];
			else
				$error = "lgroup is null";
			if(isset($_POST['lkey']) && !empty($_POST['lkey']))
				$content_item->lkey = $_POST['lkey'];
			else
				$error = "lkey is null";
			
			if($error != ""){
				echo $error;
				return;	
			}
				
			$md_string = new Models_String2();
			$count =  $md_string->delete2($content_item);

			if($count !=0)
				echo "true";
			else{	
				echo "false";
			}			
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	
	}

	public function editAction()
	{
		$md_string = new Models_String2();	
	    try{					
	       
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	
	}
}
