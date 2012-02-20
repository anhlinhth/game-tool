<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Compensation.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Compensation_Detail.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Reason.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Reason_Detail.php';
require_once ROOT_LIBRARY_UTILITY.DS.'jqgrid_helper.php';
require_once ROOT_LIBRARY_UTILITY.DS.'ChartHelper.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'PigManager.php';
require_once ROOT_APPLICATION_OBJECT_MANAGER.DS.'ItemManager.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_CONFIG.DS.'AppConstant.php';
require_once ROOT_LIBRARY.DS.'Excel/reader.php';


class CompensationController extends BaseController
{
    public function _setUserPrivileges()
    {
        return array('denbu', 'approve', 'suggestion', 'listcompensation', 'listwaitingcompensation','listcompensationdetail', 'operationcompensation', 
            'operationcompensationdetail', 'check','execute', 'checkname', 'getstatistic', 'export', 
            'listreason', 'operreason', 'listreasondetail', 'operreasondetail');
    }
    
    public function preDispatch()
    {
        parent::preDispatch();
        
        if(!$this->hasPrivilege())
            $this->_redirect ("/error/permission");
    }
    /**
    * @param mixed $paramArr
    * @return array
    * @author MaiTTT
    * 
    */
    public function listcompensationAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $this->getListCompensation($_POST['status'], $_POST['fromDate'], $_POST['toDate'], $_POST['account']);
    }
    
    public function listwaitingcompensationAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $this->getListCompensation(AppConstant::COMPENSATION_WAITING, $_POST['fromDate'], $_POST['toDate'], $_POST['account']);
    }
    
    private function getListCompensation($status, $fromDate, $toDate, $account)
    {
        $model = new Models_Compensation();

        $whereParam .= ' AND status = ' . $status;
        $whereParam .= ' AND char_name like \'%' . $account . '%\'';
        $whereParam .= ' AND ((create_date >= \'' . $fromDate . '\'';
        $whereParam .= ' AND create_date <= DATE_ADD(\'' . $toDate. '\', INTERVAL 1 DAY))';
        $whereParam .= ' OR ( approve_date >= \'' . $fromDate. '\'';
        $whereParam .= ' AND approve_date <= DATE_ADD(\'' . $toDate. '\', INTERVAL 1 DAY)))';
        
        buildGridData(
            array(
                'model'   => $model,
                'method'  => 'getCompensation',
                'pkid'    => 'id',
                'whereParam' => $whereParam,
                'columns' => array( 'id','char_name','char_id','reason', 'reason_id','reason_desc', 'reason_detail_id','comment','status','create_date','create_by','approve_date','approve_by','execute_date','execute_by')
            )
        );
    }
    /**
    * @param mixed $paramArr
    * @return array
    * @author MaiTTT
    * 
    */    
    public function listcompensationdetailAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        $model = new Models_Compensation_Detail();
        $whereParam = ' AND cd.compensation_id = ' . $_POST['compensation_id'] ;
        buildGridData(
            array(
                'model'   => $model,
                'method'  => 'getCompensationDetail',
                'pkid'    => 'id',
                'whereParam' => $whereParam,
                'columns' => array( 'id','compensation_id','type','name','rank','image','quantity','object_id')
            )
        );
    }
    /**
    * @param mixed $paramArr
    * @return array
    * @author MaiTTT
    * 
    */
    public function operationcompensationAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        $model = new Models_Compensation();
        $action = $_POST['oper'];
        switch( $action ){
            case 'add' :
                $arr['CharName'] = $_POST['CharName'];
                $arr['CharID'] = $_POST['CharID'];
                $arr['Comment'] = $_POST['Comment'];
                $arr['Reason'] = $_POST['Reason'];
                $arr['reason_id'] = $_POST['reason_id'];
                $arr['reason_detail_id'] = $_POST['reason_detail_id'];
                $arr['ReasonDesc'] = $_POST['ReasonDesc'];
                $arr['CreateBy'] = Zend_Auth::getInstance()->getIdentity()->username;
                $model->insertCompensation($arr);
                Models_Log::insert($this->view->user->username, 'act_add_compensation');
                break;
            case 'edit' :
                $arr['id'] = $_POST['id'];
                $arr['CharName'] = $_POST['CharName'];
                $arr['Comment'] = $_POST['Comment'];
                $arr['Reason'] = $_POST['Reason'];
                $arr['ReasonDesc'] = $_POST['ReasonDesc'];
                $arr['reason_id'] = $_POST['reason_id'];
                $arr['reason_detail_id'] = $_POST['reason_detail_id'];
                $model->updateCompensation($arr);
                Models_Log::insert($this->view->user->username, 'act_edit_compensation');
                break;
            case 'del' :
                $arr['id'] = $_POST['id'];
                // Frist: delete compensation detail
                $md = new Models_Compensation_Detail();
                $md->deleteCompensationDetail($arr);
                // Second: delete compensation
                $model->deleteCompensation($arr);
                Models_Log::insert($this->view->user->username, 'act_del_compensation');
                break;               
        }
    
    }
    
    /**
    * Get item / pig for auto complete search
    * 
    * @return json data
    * @author KietMA
    */
    public function suggestionAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        $type = $_POST['type'];
        $desc = $_POST['desc'];
        switch ($type)
        {
            case AppConstant::GIFT_TYPE_PIG:
                $xmlDoc = Utility::openXML(XML_PATH);
                $returnData = PigManager::GetInstance()->SearchByDesc($xmlDoc, $desc);
                echo json_encode($returnData);
                break;
            case AppConstant::GIFT_TYPE_ITEM:
            case AppConstant::GIFT_TYPE_GROUPITEM:
                $xmlDoc = Utility::openXML(XML_PATH);
                $returnData = ItemManager::GetInstance()->SearchByDesc($xmlDoc, $type, $desc);
                echo json_encode($returnData);
                break;
            default:
                break;
        }
    }
    
    /**
    * @param mixed $paramArr
    * @return array
    * @author MaiTTT
    * 
    */
    public function operationcompensationdetailAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        $model = new Models_Compensation_Detail();
        $action = $_POST['oper'];

        switch( $action ){
            case 'add' :
                    $bool =  $this->checkCompesation($_POST['compensation_id']);
                    if($bool == true)
                    {
                        $arr['name'] = $_POST['name'];
                        $arr['image_save'] = $_POST['image_save'];
                        $arr['object_id'] = $_POST['object_id'];
                        $arr['quantity'] = $_POST['quantity'];
                        $arr['type'] = $_POST['type'];
                        $arr['rank'] = $_POST['rank'];
                        $arr['compensation_id'] = $_POST['compensation_id'];
                        $model->insertCompensationDetail($arr);
                        Models_Log::insert($this->view->user->username, 'act_add_compensation_detail');
                    }
                   
                    break;
            case 'edit' :
                    $arr['id'] = $_POST['id'];
                    $arr['compensation_id'] = $_POST['compensation_id'];
                    $arr['type'] = $_POST['type'];
                    $arr['quantity'] = $_POST['quantity'];
                    $arr['object_id'] = $_POST['object_id'];
                    $arr['name'] = $_POST['name'];
                    $arr['image_save'] = $_POST['image_save'];
                    $arr['rank'] = $_POST['rank'];
                    $model->updateCompensationDetail($arr);
                    Models_Log::insert($this->view->user->username, 'act_edit_compensation_detail');
                    break;
            case 'del' :
                    $id = $_POST['id'];
                    $model->_delete($id, null);
                    Models_Log::insert($this->view->user->username, 'act_del_compensation_detail');
                    break;               
        }            
    }

    
    function checkCompesation($id)
    {
        $model = new Models_Compensation();
        return $model->checkCompesation($id);
    }
    public function importAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();        
        $fileName =  $_FILES['filePath']['tmp_name'];
        $data = new Spreadsheet_Excel_Reader();
        $data->read($fileName);
    }
    public function approveAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();  
        $arr = $_POST['listId'];     
        $type =  $_POST['type'];
        $by = Zend_Auth::getInstance()->getIdentity()->username;
        $date = date(AppConstant::DATE_TIME_FORMAT);
        $model = new Models_Compensation();
        $result = $model->approveCompesation($arr,$type, $by, $date);
        if (type == AppConstant::COMPENSATION_APRROVED)
        {
            Models_Log::insert($this->view->user->username, 'act_approve_compensation');
        }
        else if (type == AppConstant::COMPENSATION_DENIED)
        {
            Models_Log::insert($this->view->user->username, 'act_deny_compensation');
        }
        else if (type == AppConstant::COMPENSATION_WAITING)
        {
            Models_Log::insert($this->view->user->username, 'act_wait_compensation');
        }
        echo json_encode($result);
    }
    
    /**
    * Execute the compensation
    * 
    * @author KietMA
    */
    public function executeAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        $modelCompensation = new Models_Compensation();
        $modelCompensationDetail = new Models_Compensation_Detail();
        $objSearch->status = AppConstant::COMPENSATION_APRROVED; // Da approve
        $compensations = $modelCompensation->_filter($objSearch, "id DESC", 0, 0);
        
        $count = 0;
        $dbInstance = Utility::initMembase();
        
        foreach($compensations as $compensation)
        {
            $key = AppConstant::KEY_COMPENSATION.$compensation->char_id;
            $objDetailSearch->compensation_id = $compensation->id;
            // Get compensation detail
            $details = $modelCompensationDetail->_filter($objDetailSearch, 'id DESC', 0, 0);
            
            $all = $dbInstance->get($key);
            if (!$all)
            {
                $all = array();
            }
            
            if (count($details) > 0)
            {
                foreach($details as $detail)
                {
                    $val = array();
                    $val['type'] = $detail->type;
                    $val['id'] = array($detail->object_id);
                    $val['qty'] = (int)$detail->quantity;
                    $val['rank'] = $detail->rank?(int)$detail->rank:$detail->rank;
                    
                    $all[] = $val;
                }
                
                // Put to memcache
                $dbInstance->set($key, $all);
                // Sau khi day vao membase thanh cong, update status -> DA XU LY
                $compensation->status = AppConstant::COMPENSATION_EXECUTED;
                $compensation->execute_by = Zend_Auth::getInstance()->getIdentity()->username;
                $compensation->execute_date = date(AppConstant::DATE_TIME_FORMAT);
                $modelCompensation->update($compensation);
                $count++;
            }
        }
        Models_Log::insert($this->view->user->username, 'act_exec_compensation');
        
        echo "Đã đền bù thành công cho $count gamer!";
    }
    
    /**
    * Check charname has exist or not
    * 
    * @author KietMA
    */
    public function checknameAction()
    {
        $charName = $_GET['charname'];
        $charName = strtolower($charName);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        
        // Init membase instance
        $dbInstance = Utility::initMembase();
        $charId = $dbInstance->get($charName);
        echo $charId;
    }
    
    
    public function getstatisticAction()
    {
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$model = new Models_Compensation();
		echo json_encode($model->getStatistic($_POST));
    }

    public function exportAction()
    {
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();   
		
		$data = array();
		$p = $this->getRequest()->getParam("p");

		$data["key"] = ChartHelper::getValue($p, "key");
		$data["datefrom"] = ChartHelper::getValue($p, "datefrom");
		$data["dateto"] = ChartHelper::getValue($p, "dateto");
		$data["reason"] = ChartHelper::getValue($p, "reason");

		$name = explode(",", ChartHelper::getValue($p, "name"));

		$model = new Models_Compensation();
		$output = $model->getStatistic($data);

		Utility::exportExcel($output, $name);		 	
    }    
    
    /**
    * Get list of reason for jqgrid
    * 
    */
    public function listreasonAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $model = new Models_Reason();
        
        buildGridData(
            array(
                'model'   => $model,
                'method'  => 'getReason',
                'pkid'    => 'id',
                'whereParam' => '',
                'columns' => array( 'id','name')
            )
        );
    }
    
    /**
    * Execute action for reason
    * @author KietMA
    */
    public function operreasonAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        $model = new Models_Reason();
        $action = $_POST['oper'];

        $model = new Models_Reason();
        
        switch( $action ){
            case 'add' :
                $arr['name'] = $_POST['name'];
                $model->insert($arr);
                Models_Log::insert($this->view->user->username, 'act_add_reason');
                break;
            case 'edit' :
                $arr['id'] = $_POST['id'];
                $arr['name'] = $_POST['name'];
                $model->update($arr);
                Models_Log::insert($this->view->user->username, 'act_edit_reason');
                break;
            case 'del' :
                $id = $_POST['id'];
                $model->_delete($id, null);
                Models_Log::insert($this->view->user->username, 'act_del_reason');
                break;               
        }               
    }
    
    /**
    * Get list of reason for jqgrid
    * 
    */
    public function listreasondetailAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $model = new Models_Reason_Detail();
        $whereClause = ' AND rd.reason_id = ' . $_POST['reason_id'] ;
        
        buildGridData(
            array(
                'model'   => $model,
                'method'  => 'getReasonDetail',
                'pkid'    => 'id',
                'whereParam' => $whereClause,
                'columns' => array( 'id', 'reason_id','name', 'enable')
            )
        );
    }
    
    /**
    * Execute action for reason
    * @author KietMA
    */
    public function operreasondetailAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNorender();
        $model = new Models_Reason();
        $action = $_POST['oper'];

        $model = new Models_Reason_Detail();
        
        switch( $action ){
            case 'add' :
                $arr['name'] = $_POST['name'];
                $arr['reason_id'] = $_POST['reason_id'];
                $arr['enable'] = $_POST['enable'];
                $model->insert($arr);
                Models_Log::insert($this->view->user->username, 'act_add_reason_detail');
                break;
            case 'edit' :
                $arr['id'] = $_POST['id'];
                $arr['name'] = $_POST['name'];
                $arr['reason_id'] = $_POST['reason_id'];
                $arr['enable'] = $_POST['enable'];
                $model->update($arr);
                Models_Log::insert($this->view->user->username, 'act_edit_reason_detail');
                break;
            case 'del' :
                $id = $_POST['id'];
                $model->_delete($id, null);
                Models_Log::insert($this->view->user->username, 'act_del_reason_detail');
                break;               
        }               
    }
}  
?>
