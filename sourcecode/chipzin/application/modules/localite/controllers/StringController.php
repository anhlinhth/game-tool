<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_AwardType.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_AwardType.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_AwardType.php';

require_once ROOT_APPLICATION.DS.'modules'.DS.'localite'.DS.'models'.DS.'Models_String.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localite'.DS.'models'.DS.'Models_Export.php';

class Localite_StringController extends BaseController
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
		$string = new Models_String();		
		
		if(isset($_REQUEST['l_language']))
			$string->updateindexlang($_REQUEST['l_language']);
		if(isset($_REQUEST['id'])&&isset($_REQUEST['group']))
			$string->DelBykeyAndGroup($_REQUEST['id'], $_REQUEST['group']);
			
		$page = $this->_request->getParam("page",'1');
		$size = $this->_request->getParam("size",'40');
		
		$l_group = $this->_request->getParam("l_group",-1);
		$id_s = $this->_request->getParam("S_ID",-1);
		if($id_s=='') $id_s=-1;
		$l_Search_type = $this->_request->getParam("l_Search_type",'lkey');
		
		//replate
		$this->view->data = $string->getDataByLang($l_group,$page,$size,$id_s,$l_Search_type);
		$btreplace = $this->_request->getParam("btreplace",'0');
		$replace = $this->_request->getParam("replace",-1);
		$this->view->replace = $replace;
		if($btreplace == "Replace")
		{
			if($id_s==-1||$replace==-1)
				$this->view->errMsg = "Xin vui lòng điền đầy đủ thông tin";
			foreach ($this->view->data as $value)
			{
				if($this->_request->getParam($value['id'],'0')=="on")
					$string->updateReplace($value['id'], $id_s, $replace);
			}
		}
		////
		
		$this->view->data = $string->getDataByLang($l_group,$page,$size,$id_s,$l_Search_type);
		$this->view->datanopage =  $string->getDataByLangNopage($l_group,$id_s,$l_Search_type);
		$this->view->page = $page;
		$this->view->size = $size;
		$this->view->group = $string->getGroup();
		$this->view->language = $string->getlanguage();
		$this->view->string = $string;
		$this->view->l_group = $l_group;
		$this->view->l_Search_type = $l_Search_type;
		$this->view->id_s = $id_s;
	}
	public function insertAction()
	{
		$string = new Models_String();		
		$this->view->group = $string->getGroup();
		$this->view->string = $string;
		$this->view->test = $this->_request->getParam("test",-1);
		$this->view->test1 = $this->_request->getParam("test1",-1);
		if(isset($_REQUEST['key'])&&isset($_REQUEST['l_group'])&&isset($_REQUEST['test'])&&isset($_REQUEST['test1']))
		{
			if($_REQUEST['key']==''||$_REQUEST['l_group']==''||$_REQUEST['test']==''||$_REQUEST['test1']=='')
				$this->view->errMsg = "Xin vui lòng điền đầy đủ thông tin";
			else
			if(!$string->checkIdandGroup($_REQUEST['key'], $_REQUEST['l_group']))
			{
				$this->view->errMsg = "Bản dịch này có thể đã có trong CSDL.</br>Xin vui lòng kiểm tra lại!";
			}
			else 
			{
				$string->insert($_REQUEST['key'], $_REQUEST['l_group'], $_REQUEST['test'], $_REQUEST['test1']);
				$this->_redirect('/localite/string/index');
			}
		}
	}
	public function updateAction()
	{
		$string = new Models_String();
		$this->view->group = $string->getGroup();
		$this->view->string = $string;
		$this->view->test = $this->_request->getParam("test",-1);
		$this->view->test1 = $this->_request->getParam("test1",-1);
		if(isset($_REQUEST['key'])&&isset($_REQUEST['l_group'])&&isset($_REQUEST['test'])&&isset($_REQUEST['test1']))
		{
			if($_REQUEST['key']==''||$_REQUEST['l_group']==''||$_REQUEST['test']==''||$_REQUEST['test1']=='')
				$this->view->errMsg = "Xin vui lòng điền đầy đủ thông tin";
			else 
			{
				$string->update($_REQUEST['key'], $_REQUEST['group'], $_REQUEST['test'], $_REQUEST['test1']);
				//$this->_redirect('/localite/string/index');
			}
		}
	}
	public function testAction()
	{
		
	}
	public function viewkeyAction()
	{
		$string = new Models_String();
		$model = new Models_Export();
		$tam = $this->_request->getParam("value",'');
		$lang = $string->getlangdefaultid();
		if($tam!='')
			echo '/n/'.$model->Replacekeyintext($model->gettextbykey($lang, $tam), $lang).'/n/';
		else echo '/n//n/';
	}
	
	//////////////////////////ThaoNX///////////////////////////
	public function editAction()
	{
		$md_string = new Models_String();	
	    try{					
	        $viewtype = $this->_request->getParam('view');		
			if($viewtype=="dialog"){
				$this->_helper->layout->disableLayout();
				if($this->_request->isPost()){
				    $this->_helper->viewRenderer->setNoRender();					
					$key = $_POST['key'];
					$group_name = $_POST['group_name'];
					$default 	= $_POST['default'];
					$index 		= $_POST['index'];						
					$md_string->update2($key,null,$group_name, $default, $index);				
					echo $default;
					return;
				}
			}
			$string = $this->_request->getParam("string");	
			
			$arrString = explode('#',$string);		
			$key   	= $arrString[1];
			$group_name = substr($arrString[0],1);			
			$lang_default_id = $md_string->getlangdefaultid();
			$lang_index_id = $md_string->getlangindexid();
			
			$this->view->lang_default_text = $md_string->getTextBylang2($lang_default_id, $key, $groupid,$group_name);			
			$this->view->lang_index_text = $md_string->getTextBylang2($lang_index_id, $key, $groupid,$group_name);
				
			$this->view->group_name = $group_name;		
	        $this->view->key = $key;
			
			$this->view->viewtype = $viewtype;
	        $this->view->lang_default = $md_string->getlangdefault();
	        $this->view->lang_index = $md_string->getlangindex();			
	        
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	
	}
}
