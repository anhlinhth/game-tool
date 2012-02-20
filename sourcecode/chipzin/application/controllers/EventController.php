<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Event_GoldExp.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Event_NamThien.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Event.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Event_GoldExp.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Event_NamThien.php';
require_once ROOT_LIBRARY_UTILITY.DS.'jqgrid_helper.php';

class EventController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','goldexp','delelegoldexp','namthien', 'dsevent', 'listkey');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	
	public function indexAction()
	{
		if(Utility::checkPrivilege($this->view, 'event', 'goldexp'))
			$this->_redirect ("/event/goldexp");
		if(Utility::checkPrivilege($this->view, 'event', 'namthien'))
			$this->_redirect ("/event/goldexp");
        if(Utility::checkPrivilege($this->view, 'event', 'dsevent'))
            $this->_redirect ("/event/dsevent");
            
	}
	
	public function goldexpAction()
    {
        try
        {
			$mdEvent = new Models_Event_GoldExp();	
        
            if($this->_request->getMethod() == 'POST')
            {
				$arrId			= $this->_request->getParam("hidId");
				$arrBeginTime	= $this->_request->getParam("txtBeginTime");
				$arrEndTime		= $this->_request->getParam("txtEndTime");
				$arrGold		= $this->_request->getParam("txtGold");
				$arrExp		= $this->_request->getParam("txtExp");			
				
				if($arrBeginTime)
				{
					$count = count($arrBeginTime);
					for($i = 0; $i < $count; $i++)
					{
						$beginTime	= $arrBeginTime[$i];
						$endTime	= $arrEndTime[$i];
						
						$beginTime = explode(" ", $beginTime);
						$mmddyyBegin = explode("/", $beginTime[0]);
						$hhmmBegin	= explode(":", $beginTime[1]);
						
						$endTime	= explode(" ", $endTime);
						$mmddyyEnd	= explode("/", $endTime[0]);
						$hhmmEnd	= explode(":", $endTime[1]);
						
						$obj		= new Obj_Event_GoldExp();
						$obj->id	= $arrId[$i];
						$obj->min	= mktime($hhmmBegin[0],$hhmmBegin[1],$hhmmBegin[2],$mmddyyBegin[0],$mmddyyBegin[1],$mmddyyBegin[2]);
						$obj->max	= mktime($hhmmEnd[0],$hhmmEnd[1],$hhmmEnd[2],$mmddyyEnd[0],$mmddyyEnd[1],$mmddyyEnd[2]);
						$obj->gold	= $arrGold[$i];
						$obj->exp	= $arrExp[$i];
						
						if($obj->id)
							$mdEvent->_update ($obj);
						else
							$mdEvent->_insert ($obj);
					}
				}
				
				$data = $mdEvent->_filter();		
						
				$this->view->count	= (int)count($data);
				$this->view->data	= $data;
				
				if($this->_request->getParam("hidSync"))
				{		
					$location = $this->_request->getParam("hidLocation");				
					
					$mdEvent->sync($data, $location);	
					$this->view->msg = "Sync dữ liệu thành công";
					Models_Log::insert($this->view->user->username, "act_sync_event_exp");
				}
				else
				{					
					$this->view->msg = "Lưu thành công";		
					Models_Log::insert($this->view->user->username, "act_edit_event_exp");
				}
			}		
			else
			{
				$data = $mdEvent->_filter();		
						
				$this->view->count	= (int)count($data);
				$this->view->data	= $data;
			}			
        }        
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
	
	public function delelegoldexpAction()
	{
		try
		{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNorender();
			
			if($this->_request->isPost())
			{
				$id = $this->_request->getParam("id");
				$mdEvent = new Models_Event_GoldExp();
				$mdEvent->_delete($id);
				
				Models_Log::insert($this->view->user->username, "act_delete_event_exp");
			}
		}
		catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
	
	public function namthienAction()
	{
		try
		{
			$mdEvent = new Models_Event_NamThien();
			
			if($this->_request->isPost())
			{
				//Mua nu hon
				$arrKiss = $this->_request->getParam('txtKiss');
				$arrKissCard = $this->_request->getParam('txtKissCard');
				
				$size = count($arrKiss);
				if($size > 0)
				{
					$buyKiss = "";
					for($i = 0; $i < $size; $i++)
					{
						if(!Zend_Validate::is($arrKiss[$i],"Digits") || !Zend_Validate::is($arrKissCard[$i],"Digits"))
							throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID, "Các giá trị trong [Mua nụ hôn] phải là số");
						
						if($buyKiss == "")
							$buyKiss .= "{$arrKiss[$i]}:{$arrKissCard[$i]}";
						else
							$buyKiss .= ",{$arrKiss[$i]}:{$arrKissCard[$i]}";
					}
				}
				
				//Nhiem vu
				$arrQuest = $this->_request->getParam('txtQuest');
				$arrQuestCard = $this->_request->getParam('txtQuestCard');
				$size = count($arrQuest);
				if($size > 0)
				{
					$quest = "";
					for($i = 0; $i < $size; $i++)
					{
						if(!Zend_Validate::is($arrQuest[$i],"Digits") || !Zend_Validate::is($arrQuestCard[$i],"Digits"))
							throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID, "Các giá trị trong [Nhiệm vụ] phải là số");
						
						if($quest == "")
							$quest .= "{$arrQuest[$i]}:{$arrQuestCard[$i]}";
						else
							$quest .= ",{$arrQuest[$i]}:{$arrQuestCard[$i]}";
					}
				}
				
				//Dap heo dat
				$arrHit= $this->_request->getParam('txtHit');
				$arrHitPigCard = $this->_request->getParam('txtHitPigCard');
				$size = count($arrHit);
				if($size > 0)
				{
					$hitpig = "";
					for($i = 0; $i < $size; $i++)
					{
						if(!Zend_Validate::is($arrHit[$i],"Digits") || !Zend_Validate::is($arrHitPigCard[$i],"Digits"))
							throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID, "Các giá trị trong [Đập heo đất] phải là số");
						
						if($hitpig == "")
							$hitpig .= "{$arrHit[$i]}:{$arrHitPigCard[$i]}";
						else
							$hitpig .= ",{$arrHit[$i]}:{$arrHitPigCard[$i]}";
					}
				}
				
				//Hop qua dac biet
				$giftCard = $this->_request->getParam("txtGiftCard");
				if(!Zend_Validate::is($giftCard,"Digits"))
					throw new Invalid_Argument_Exception(Invalid_Argument_Exception::ERR_FIELD_INVALID, "Các giá trị trong [Hộp quà đặc biệt] phải là số");
				
				$obj = new Obj_Event_NamThien();
				$obj->buy_kiss		= $buyKiss;
				$obj->quest			= $quest;
				$obj->special_gift	= $giftCard;
				$obj->hit_pig		= $hitpig;
				
				$check = $mdEvent->getEvent();
				if(!$check)
					$mdEvent->_insert($obj);
				else
					$mdEvent->update($obj);
				
				if($this->_request->getParam("hidSync"))
				{			
					$location = $this->_request->getParam("hidLocation");				
					
					$mdEvent->sync($obj,$location);	
					$this->view->msg = "Sync dữ liệu thành công";
					Models_Log::insert($this->view->user->username, "act_sync_event_namthien");
				}
				else
				{
					$this->view->msg = "Lưu thành công";
					Models_Log::insert($this->view->user->username, "act_edit_event_namthien");
				}
			}
			
			$obj = $mdEvent->getEvent();
			$arrBuyKiss = explode(",", $obj->buy_kiss);
			$arrQuest	= explode(",", $obj->quest);
			$arrHitPig	= explode(",", $obj->hit_pig);
			
			$this->view->arrBuyKiss = $arrBuyKiss;
			$this->view->arrQuest = $arrQuest;
			$this->view->arrHitPig = $arrHitPig;
			$this->view->obj = $obj;
		}
		catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
	}
    /**
    * @author MaiTTT
    * Event Config
    */    
    public function dseventAction()
    {
        
    }
    public function listeventAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();      	
    	$model = new Models_Event();
        buildGridData(
            array(
                'model'   => $model,
                'method'  => 'getListEventConfig',
                'pkid'    => 'id',
                'columns' => array( 'id','name','name_config','desc','start_date','end_date','enable')
            )
        );    	
    } 
    public function operationeventAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();   

        $model = new Models_Event();
        $action = $_POST['oper'];
        switch( $action ){
            case 'add' :
                $arr['name'] = $_POST['name'];
				$arr['name_config'] = $_POST['name_config'];
				$arr['desc'] = $_POST['desc'];
				$arr['start_date'] = $_POST['start_date'];
				$arr['end_date'] = $_POST['end_date'];
				$arr['enable'] = $_POST['enable'];
                $model->insertEventConfig($arr);
                //Models_Log::insert($this->view->user->username, 'act_add_eventconfig');            	
            	break;
            case 'edit' :  
            	$arr['id'] = $_POST['id'];
                $arr['name'] = $_POST['name'];
				$arr['name_config'] = $_POST['name_config'];
				$arr['desc'] = $_POST['desc'];
				$arr['start_date'] = $_POST['start_date'];
				$arr['end_date'] = $_POST['end_date'];
				$arr['enable'] = $_POST['enable'];
                $model->updateEventConfig($arr);
                //Models_Log::insert($this->view->user->username, 'act_update_eventconfig');                       	
            	break;
            case 'del' :
               $arr['id'] = $_POST['id'];
                $model->deleteEventConfig($arr);
                //Models_Log::insert($this->view->user->username, 'act_del_eventconfig');
            	break;
        }      	        	
    }        
	public function listdetaileventAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();    
        $idEvent = $_POST["idEvent"];
        $nameEvent = $_POST["nameEvent"];
        $result = $this->buildKeyChildrenEvent($idEvent,$nameEvent,0);
        echo json_encode($result);
    }

	private function buildKeyChildrenEvent($idEvent,$nameEvent,$idParent)
	{
		$model = new Models_Event();
		$listKey = $model->getListKeyEvent($idEvent,$idParent);
		$countListKey = count($listKey);
		$arrResult = array();
		
		for($i=0;$i<$countListKey;$i++)
		{
			$arrNode = array();
			$key = $listKey[$i];
			if($key['type'] == 2)
			{
				if($key['id_parent'] == 0)
				{
					$arrNode['title'] = $nameEvent;
				}
				else {
					$arrNode['title'] = $key['name'];
				}
				$arrNode['key'] = $key['id'];
				$arrNode['isFolder'] = true;
				$arrNode['children'] = $this->buildKeyChildrenEvent($idEvent,$nameEvent,$key['id']);
			}
			else 
			{
				continue;
			}
			array_push($arrResult, $arrNode);
		}
		
		return $arrResult;
	}
    public function listkeyAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();     
        
        $model = new Models_Event();
        $keyParent = $_POST["keyNode"];
       	$whereParam .= ' AND k.id_parent  = ' . $keyParent;       
        buildGridData(
            array(
                'model'   => $model,
                'method'  => 'getListKeyEventConfig',
                'pkid'    => 'id',
	            'whereParam' => $whereParam,
                'columns' => array( 'id','id_event','name','desc','type','value','id_parent')
            )
        );
                    
    }		  
	public function operationkeyAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();   
        $model = new Models_Event();
        $action = $_POST['oper'];
        switch( $action ){
            case 'add' :
            	$arr['idEventSelect'] = $_POST['idEventSelect'];
            	$arr['id_parent'] = $_POST['keyNode'];
                $arr['name'] = $_POST['name'];
				$arr['desc'] = $_POST['desc'];
				$arr['type'] = $_POST['type'];
				$arr['value'] = $_POST['value'];
                $model->insertKeyEventConfig($arr);
                //Models_Log::insert($this->view->user->username, 'act_add_keyeventconfig');             	
            	break;
            case 'edit' : 
            	$arr['id'] = $_POST['id'];
                $arr['name'] = $_POST['name'];
				$arr['desc'] = $_POST['desc'];
				$arr['type'] = $_POST['type'];
				$arr['value'] = $_POST['value'];
                $model->updateKeyEventConfig($arr);
                //Models_Log::insert($this->view->user->username, 'act_update_keyeventconfig');               	
            	break;
            case 'del' :
               	$arr['id'] = $_POST['id'];
                $model->deleteKeyEventConfig($arr);
                //Models_Log::insert($this->view->user->username, 'act_del_keyeventconfig');            	
            	break;
        }         
    }
    public function exporteventAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();   
        $arrListEvent = $_POST["listId"];
        $model = new Models_Event();
        $result =  $model->exportEventConfig($arrListEvent);
        
        echo json_encode($result);
    }  
    public function importeventAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();   
        $arrListEvent = $_POST["listId"];
        $model = new Models_Event();
        $result = $model->importEventConfig($arrListEvent);
        
        echo json_encode($result);
    }  
	public  function  syncdataAction()
	{
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();  
        $server = $_POST['server'];
        Utility::syncData($server); 
        		
	}                  
}
?>
