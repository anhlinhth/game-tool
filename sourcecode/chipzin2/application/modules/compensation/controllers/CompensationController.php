<?php
class Compensation_CompensationController extends Base_Controller
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','update','delete');
	}
	
	/**	 
	 * 
	 */
	public function preDispatch()
	{
		parent::preDispatch();
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	/**	 
	 * 
	 */	
	public function indexAction()
	{
		try{	
			$md = new Compensation_Model_Account();
			$options = $md->getOptions();			
			$this->view->options = $options;
		
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}	
	}
	/**	 
	 * 
	 */
	public function syncAction()
	{
		try{
			$md = new Compensation_Model_Account();
			$options = $md->getOptions();
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();					
			var_dump($_POST);		
			$ID = $_POST["ID"];
			$arr_modify = $_POST["Modify"];
			$md = new Compensation_Model_Account();
			$session_item = new Obj_Base();
			$session_item->ChangeBy = $this->view->user->username;
			$session_item->UserID = $ID;
			$session_id = $md->createSession($session_item);
			foreach($arr_modify as $row){
				$item = new Obj_Base();
				$item->SessionID = $session_id;
				$item->Path = $row['path'];
				$item->OldValue = $row['old_value'];
				$item->NewValue = $row['new_value'];			
				$md->logs($item);				
			}
		}
		catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}	
	}
	// public function savechangedAction()
	// {		
	    // try{	
			// $this->_helper->layout->disableLayout();
			// $this->_helper->viewRenderer->setNorender();
			
	        // $item = new Obj_Base();
			// $item->Path = $_POST['path'];
			// $item->OldValue = $_POST['old_value'];
			// $item->NewValue = $_POST['new_value'];
			// $md = new Compensation_Model_Account();
			// $rs = $md->savechanged($item);
			// if($rs != 0){
				// echo 1;// successfull
			// }	
	    // }catch (Exception $ex)
		// {
			// $this->view->errMsg = $ex->getMessage();
			// echo $this->view->errMsg;
            // Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		// }
	// }
	
	/**	 
	 * 
	 */	
	public function logsAction()
	{		
	    try{	
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			
			$ID = $_POST["ID"];
			$arr_modify = $_POST["Modify"];
			$md = new Compensation_Model_Account();
			$session_item = new Obj_Base();
			$session_item->UserChange = $this->view->user->username;
			$session_item->UserID = $ID;
			$session_id = $md->createSession($session_item);
			foreach($arr_modify as $row){
				$item = new Obj_Base();
				$item->SessionID = $session_id;
				$item->Path = $row['path'];
				$item->OldValue = $row['old_value'];
				$item->NewValue = $row['new_value'];			
				$md->logs($item);				
			}
			
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	/**	 
	 * 
	 */	
	public function getlogsAction()
	{		
	    try{	
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();			
			$page = $_GET["page"];
			$num  = $_GET["num"];
			$md   = new Compensation_Model_Account();
			$arr = array();
			$arr["count"] = $md->countLogSession();
			$log_session = $md->getLogSession($page,$num);			
			//$rs = $md->getLogs();
			foreach($log_session as $key=>$session){
				$log_session[$key]->Detail = $md->getLogDetail($session->SessionID);	
			}			
			$arr["session"] = $log_session;
			echo json_encode($arr);
			
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	/**	 
	 * 
	 */	
	public function deletelogsAction()
	{		
	    try{	
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();			
			$arr_id = $_POST['ARRAY_ID'];
			$md = new Compensation_Model_Account();
			if(!empty($arr_id)){
				foreach($arr_id as $id){
					$md->deleteLog($id);
				}							
			}	
			echo "1";
			
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	/**	 
	 * 
	 */	
	public function optionsAction()
	{		
	    try{	
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();			
			$md = new Compensation_Model_Account();
			$item = new Obj_Base();
			$item->GetFrom = $_POST["GetFrom"];
			$item->PostTo= $_POST["PostTo"];
			$md->updateOptions($item);
			echo "1";
	    }catch (Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	/**	 
	 * 
	 */	
	public function getdataAction()
	{
		try{
			$md = new Compensation_Model_Account();
			$options = $md->getOptions();
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();			
			$userid = $_GET["userid"];				
			if($userid != null){
				//echo $userid;
				echo file_get_contents($options->GetFrom.$userid);
				//echo $options->GetFrom;
			}else
				echo "";
		}catch(Exception $ex){
			$this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	/**	 
	 * 
	 */	
	public function downloadAction()
	{
		try{
			$md = new Compensation_Model_Account();
			$options = $md->getOptions();
			//$this->_helper->layout->disableLayout();
			//$this->_helper->viewRenderer->setNoRender();			
			$userid = $_GET["userid"];				
			if($userid != null){				
				$string = file_get_contents($options->GetFrom.$userid);						
				$filename = $userid.'_'. date('Y-M-d', time());
				header('Content-Type: text/plain');
				header('Content-disposition: attachment; filename=' . $filename . '.sjon');
				ob_start();
				echo ($string);
			}else
				echo "";
				// $string = "I should have really done some laundry tonight.";
 
				// $stream = fopen('data://text/plain;base64,' . base64_encode($string),'r');
				 
				// print stream_get_contents($stream);
		}catch(Exception $ex){
			$this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
		
}
