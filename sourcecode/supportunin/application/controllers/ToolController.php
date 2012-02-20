<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Popup.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION_MODELS.DS.'Pig.php';
require_once ROOT_APPLICATION_MODELS.DS.'Item.php';
require_once ROOT_APPLICATION_MODELS.DS.'Common.php';
require_once ROOT_CONFIG.DS.'AppConstant.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Reason.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Reason_Detail.php';

$GLOBALS['THRIFT_ROOT'] = ROOT_LIBRARY_UTILITY_SCRIBE;
include_once $GLOBALS['THRIFT_ROOT'] . '/scribe.php';
include_once $GLOBALS['THRIFT_ROOT'] . '/transport/TSocket.php';
include_once $GLOBALS['THRIFT_ROOT'] . '/transport/TFramedTransport.php';
include_once $GLOBALS['THRIFT_ROOT'] . '/protocol/TBinaryProtocol.php';

class ToolController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','notice','compensation','popup', 'compensationplayer', 'denbu', 'approve','statistic', 'reason');
	}
	
	public function preDispatch()
	{
		parent::preDispatch();
		
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	
	public function indexAction()
	{
		if(Utility::checkPrivilege($this->view, 'tool', 'notice'))
			$this->_redirect ("/tool/notice");
		
		if(Utility::checkPrivilege($this->view, 'tool', 'compensation'))
			$this->_redirect ("/tool/compensation");
            
        if(Utility::checkPrivilege($this->view, 'tool', 'popup'))
            $this->_redirect ("/tool/popup");
            
        if(Utility::checkPrivilege($this->view, 'shopeditor', 'pig'))
            $this->_redirect ("/shopeditor/pig");
            
        if(Utility::checkPrivilege($this->view, 'tool', 'compensationplayer'))
            $this->_redirect ("/tool/compensationplayer");
            
        if(Utility::checkPrivilege($this->view, 'tool', 'denbu'))
            $this->_redirect ("/tool/denbu");
        if(Utility::checkPrivilege($this->view, 'tool', 'approve'))
            $this->_redirect ("/tool/approve");
        if(Utility::checkPrivilege($this->view, 'tool', 'statistic'))
            $this->_redirect ("/tool/statistic");
        if(Utility::checkPrivilege($this->view, 'tool', 'reason'))
            $this->_redirect ("/tool/reason");
	}
	
	public function noticeAction()
	{
		try
		{
			$dbInstance = Utility::initMemCache();
		
			if($this->_request->getMethod() == 'POST')
			{
				$arrNotice = $this->_request->getParam("txtNotice");
                $arrStartDate = $this->_request->getParam("txtStart");
                $arrEndDate = $this->_request->getParam("txtEnd");
                $arrStartTime = $this->_request->getParam("txtStartTime");
                $arrEndTime = $this->_request->getParam("txtEndTime");
                
                $count = count($arrNotice);
                
                $datas = array();
                for($i = 0; $i < $count; $i++)
                {
                    $startDate = $arrStartDate[$i];
                    $startTime = $arrStartTime[$i];
                    $endDate = $arrEndDate[$i];
                    $endTime = $arrEndTime[$i];
                    $start = strtotime("$startDate $startTime");
                    $end = strtotime("$endDate $endTime");
                    
                    $item = array();
                    $item['data'] = $arrNotice[$i];
                    $item['start'] = $start;
                    $item['end'] = $end;
                    
                    $datas[] = $item;
                }
                
				$retv = $dbInstance->set("servernews",$datas);
				if(!$retv)				
					throw new Internal_Error_Exception("Can not set data to memcache!");									

				$this->view->msg = "Lưu thành công";
				
				Models_Log::insert($this->view->user->username, "act_edit_notice");
			}

			$news =  $dbInstance->get("servernews");
			$this->view->data = $news;
			$this->view->count = (int)count($news);
		}		
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
	
	public function compensationAction()
	{
		try
		{			
			if($this->_request->isPost())
			{
				$file = $_FILES['file'];				
				$fileName = Utility::validateCsvFile($file, ROOT_UPLOAD);
				
				if($fileName == 'file')
					throw new Internal_Error_Exception("Định dạng file không đúng");
				elseif($fileName == 'move')
					throw new Internal_Error_Exception("Không thể chuyển file lên server");				
				
				$countSuccess = 0;
				$countFailed = 0;
				
				$pigNames = Utility::getPigNameDefault();
				$pigs = require_once ROOT_CONFIG.DS.'Pig.php';
                $isRetry = false;
				
				$dbInstance = Utility::initMembase();
				if (($handle = fopen(ROOT_UPLOAD.DS.$fileName, 'r')) !== false)
				{
					$traceFile = date("Ymd")."_denbu.txt";
					$handle2 = fopen(ROOT_UPLOAD.DS.$traceFile, 'a+');
					$strWrite = "===== START FILE: ".$fileName." =====\n";
					fputs($handle2, $strWrite);
					while(($data = fgetcsv($handle, 1000, ",")) !== false)
					{
						$userName = strtolower($data[1]);
						$playerId = $dbInstance->get($userName);
						$keyPlayer = 'user_'.$playerId;

						$now = date('Y-m-d H:i:s');
						$strWrite = "[$now] - STT: $data[0], charId: $userName, action: $data[2], id: $data[3], qty: $data[4], status: ";

						$player = $dbInstance->get($keyPlayer);
						if (!$playerId)
						{
							$strWrite .= "Failed. Player does not exist!\n";
							$countFailed++;
						}
						else
						{
							try
							{
								switch($data[2])
								{
									case 'gold':
										// Den bu vang
                                        $keyGold = 'gold_'.$playerId;
                                        $gold = $dbInstance->get($keyGold);
										$gold += (int)$data[4];
										$dbInstance->set($keyGold, $gold, FALSE);
										$strWrite .= "DONE\n";
										break;
									case 'xu':
										// Den bu xu
										$keyCoin = 'coin_'.$playerId;
										$playerCoin = $dbInstance->get($keyCoin);
										if (!$playerCoin)
										{
											$playerCoin = 0;
										}
										$playerCoin += (int)$data[4]; // Cong quantity
										$dbInstance->set($keyCoin, $playerCoin, FALSE);
										$strWrite .= "DONE\n";
                                        self::addCoinEvent($player['playerId'], $player['level'], (int)$data[4], 0, $playerCoin, null);
										break;
									case 'exp':
										// Den bu kinh nghiem
										$player['honour'] += (int)$data[4];
										$dbInstance->set($keyPlayer, $player, FALSE);
										$strWrite .= "DONE\n";
										break;
									case 'kiss':
										// Den bu nu hon
                                        $keyKiss = 'kiss_'.$playerId;
                                        $playerKiss = $dbInstance->get($keyKiss);
										$playerKiss += (int)$data[4];
										$dbInstance->set($keyKiss, $playerKiss, FALSE);
										$strWrite .= "DONE\n";
										break;
									case 'item':
										// Den bu item
										$keyItem = 'item_'.$playerId;
                                        
                                        ////////lock key play item///////////////////////
                                        if(Item::lockPlayerItems($playerId) === false)
                                        {
                                            // Đã bị lock
                                            $isRetry = true;
                                        }
                                        
                                        $count = 0;
                                        while ($isRetry){
                                            $count++;
                                            fputs($handle2, $strWrite."RETRY $count");
                                            // Retry to lock key pig
                                            if(Item::lockPlayerItems($playerId))
                                            {
                                                $isRetry = false;
                                            }
                                        }
                                        
										$playerItems = $dbInstance->get($keyItem);
										if (!$playerItems)
										{
											$playerItems = array();
										}
										//$maxItemId = $player['maxItemId'];
										$rtime = $_SERVER['REQUEST_TIME'];
										for ($i = 0; $i < $data[4]; $i++)
										{
											$id = Common::getUniqId();
											$item['id'] = $id;
											$item['itemId'] = (int)$data[3];
											$item['quantity'] = 1;
											$item['useLastAgo'] = 0;
											$item['using'] = false;
											$item['createDate'] = $rtime;
											$item['haveDefault'] = 0;
                                            $item['rank'] = isset($data[5])? $data[5] : 0;
                                            $item['activeTime'] = 0;
                                            $item['endDate'] = $rtime + 720*60*60; // Han su dung 30 ngay
											$playerItems[$id] = $item;
										}
										//$player['maxItemId'] = $maxItemId;
										//$dbInstance->set($keyPlayer, $player, FALSE);
										$dbInstance->set($keyItem, $playerItems, FALSE);
                                        
                                        // Unlock player item
                                        Item::unlockPlayerItems($playerId);
										$strWrite .= "DONE\n";
										break;
									case 'groupitem':
										// Den bu groupitem
										$keyGroupItem = 'groupitem_'.$playerId;
                                        
                                        ////////lock key play group item///////////////////////
                                        if(Item::lockPlayerGroupItems($playerId) === false)
                                        {
                                            // Đã bị lock
                                            $isRetry = true;
                                        }
                                        
                                        $count = 0;
                                        while ($isRetry){
                                            $count++;
                                            fputs($handle2, $strWrite."RETRY $count");
                                            // Retry to lock key pig
                                            if(Item::lockPlayerGroupItems($playerId))
                                            {
                                                $isRetry = false;
                                            }
                                        }
                                        
                                        $rtime = $_SERVER['REQUEST_TIME'];
										$playerGroupItems = $dbInstance->get($keyGroupItem);

										if (!$playerGroupItems)
										{
											$playerGroupItems = array();
										}

										if ($playerGroupItems[$data[3]] == null)
										{
											// Add new
											$item['id'] = (int)$data[3];
											$item['itemId'] = (int)$data[3];
											$item['quantity'] = (int)$data[4];
											$item['useLastAgo'] = 0;
											$item['using'] = true;
											$item['createDate'] = $rtime;
											$item['haveDefault'] = 0;
											$playerGroupItems[$data[3]] = $item;
										}
										else
										{
											// Update so luong
											$playerGroupItems[$data[3]]['quantity'] += $data[4];
										}
										$dbInstance->set($keyGroupItem, $playerGroupItems, FALSE);
                                        
                                        // Unlock player group items
                                        Item::unlockPlayerGroupItems($playerId);
										$strWrite .= "DONE\n";
										break;
									case 'pig':
										$keyPig = 'pig_'.$playerId;
                                        
                                        ////////lock key pig///////////////////////
                                        if(Pig::lockPigs($playerId) === false)
                                        {
                                            // Đã bị lock
                                            $isRetry = true;
                                        }
                                        
                                        $count = 0;
                                        while ($isRetry){
                                            $count++;
                                            fputs($handle2, $strWrite."RETRY $count");
                                            // Retry to lock key pig
                                            if(Pig::lockPigs($playerId))
                                            {
                                                $isRetry = false;
                                            }
                                        }
                                        
                                        $playerPigs = $dbInstance->get($keyPig);

										if (!$playerPigs)
										{
											$playerPigs = array();
										}

										for ($i = 0; $i < $data[4]; $i++)
										{
											$id = Common::getUniqId();
											$birthday = date('Y-m-d H:i:s');
											$age = 1;
											$pig['id'] = $id;											
											$pig['infoId'] = $pigs[$data[3]]['id'];											
											$pig['type'] = $data[3];
											$rdn = mt_rand(0, count($pigNames)-1);
											$pig['name'] = $pigNames[$rdn];
											$pig['markFeedWeight'] = 12;
											$pig['markFeed'] = 0;
											$pig['markBath'] = 0;
											$pig['markSick'] = 0; // Danh dau thoi diem heo bat dau benh
											$pig['markMassage'] = $age;
											$pig['markHealth'] = $age; // Danh dau thoi diem bat dau tru suc khoe heo
											$pig['birthday'] = $birthday;
											$pig['decorationId'] = '';
											$pig['foods'] = array(); // Mang chua id va duration thuc an heo duoc cho an
											$pig['markBeget'] = 0;
											$pig['generation'] = 0;
											$pig['parentType'] = '';
											$pig['health'] = 100;
											$pig['feedCount'] = 0;
											$pig['begetPrice'] = 100;
											$pig['begetCount'] = array();// Mang dem so lan giao phoi trong ngay
											$pig['markGift'] = $_SERVER['REQUEST_TIME'];
											$pig['extraLife'] = 0;
											$pig['sicker'] = 0;// Luu id player gay benh cho heo
											$pig['steal'] = 0; // 0: heo chua bi trom lan nao, 1: da bi trom it nhat 1 lan
											$playerPigs[$id] = $pig;
										}

										$dbInstance->set($keyPig, $playerPigs, FALSE);
                                        
                                        // Unlock
                                        Pig::unlockPigs($playerId);
										$strWrite .= "DONE\n";
										break;
								}
								
								$countSuccess++;
							}
							catch(Exception $ex)
							{
								$strWrite .= "Failed. ".$ex."\n";	
								$countFailed++;
							}
						}
						fputs($handle2, $strWrite);
					}
					$strWrite = "===== END FILE: ".$fileName." =====\n";
					fputs($handle2, $strWrite);
					fclose($handle2);
					fclose($handle);
					
					unlink(ROOT_UPLOAD.DS.$fileName);
					
					$this->view->failed = $countFailed;
					$this->view->success = $countSuccess;
					$this->view->msg = "Đền bù thành công";
					
					Models_Log::insert($this->view->user->username, "act_compensation");
				}
			}
		}
		catch(Exception $ex)
		{
			$this->view->errMsg = $ex->getMessage();
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}
    public function popupAction()
    {
        try
        {
            require_once ROOT_APPLICATION_FORMS.DS.'Forms_Popup.php';
			
			$md = new Models_Popup();
        
            if($this->_request->getMethod() == 'POST')
            {
                $form = new Forms_Popup();
                
				$form->_requestToForm($this);
				$check = $md->getPopup();
				
                if( $_FILES['imgPath']['name'] != null )
                {                    
                    $form->obj->picname = $_FILES['imgPath']['name'];
                    move_uploaded_file( $_FILES['imgPath']['tmp_name'] , ROOT_MEDIA_IMAGE_UPLOAD.DS . $_FILES['imgPath']['name'] ) ;            
                }
				else
				{
					$form->obj->picname = $check->picname;
				}
        
				$form->validate();           
				
				
				if(!$check)
					$md->insert($form->obj);
				else
				{
					$md->update($form->obj);                
				}
				
				if($this->_request->getParam("hidSync"))
				{
					$location = $this->_request->getParam("hidLocation");				
					$md->sync($form->obj,$location);
					$this->view->msg = "Sync dữ liệu thành công";
					Models_Log::insert($this->view->user->username, "act_sync_popup");
				}
				else
				{
					$this->view->msg = "Lưu thành công";
					Models_Log::insert($this->view->user->username, "act_edit_popup");
				}
            }
            
			$obj = $md->getPopup();			
			$this->view->form = $obj; 
        }        
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    
    public function compensationplayerAction()
    {
        try
        {
            $this->view->dataPlayer = "" ;
            if( $_POST['Upload'] )
            {
                $file = $_FILES['filePath']; 
                $fileName = Utility::validateFile($file);
                
                if($fileName == 'file')
                    throw new Internal_Error_Exception("Định dạng file không đúng");
                
                $destFile = ROOT_UPLOAD.DS. $fileName ;
                $ret = move_uploaded_file( $file['tmp_name'], $destFile ) ;
                chmod($destFile, 0777);
                if($ret === false)
                {
                    throw new Internal_Error_Exception("Không upload file được");
                }
                $lines = file( ROOT_UPLOAD.DS. $fileName );    
                if( $lines === FALSE )
                {
                    throw new Internal_Error_Exception("Không load được dữ liệu file");    
                }
                
                $this->view->dataPlayer = $lines ;
            }
            if( $_POST['Save'] )
            {
                /*$arrId            = $this->_request->getParam("hidId");
                $arrInfo    = $this->_request->getParam("txtInfo");
                $arrGold        = $this->_request->getParam("txtGold");
                $arrExp        = $this->_request->getParam("txtExp");
                $arrPig        = $this->_request->getParam("txtPig");            
                $arrItem        = $this->_request->getParam("txtItem");            
                $arrGroupItem        = $this->_request->getParam("txtGroupItem");            
                $arrKiss        = $this->_request->getParam("txtKiss");            
                $arrCard        = $this->_request->getParam("txtCard");                    */
                
                $form = new Forms_CompensationPlayer();
                $form->obj->name = $this->_request->getParam("txtInfo");
                $form->obj->gold = $this->_request->getParam("txtGold");
                $form->obj->exp = $this->_request->getParam("txtExp");
                $form->obj->pig = $this->_request->getParam("txtPig");
                $form->obj->item = $this->_request->getParam("txtItem");
                $form->obj->groupitem = $this->_request->getParam("txtGroupItem");
                $form->obj->kiss = $this->_request->getParam("txtKiss");
                $form->obj->card = $this->_request->getParam("txtCard");
                
                //// lấy thông tin ở đây bằng việc sử dụng $this->obj-> ... 
            }
            
        }
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    
    public function denbuAction()
    {
        try
        {
            $modelReason = new Models_Reason();
            $data['reason'] = $modelReason->getAll();
            
            $modelReasonDetail = new Models_Reason_Detail();
            $data['reasonDetail'] = $modelReasonDetail->getAllActive();
            
            $this->view->data = $data;
        }        
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    public function subgridAction()
    {
        
    }
    public function approveAction()
    {
        try
        {
            $modelReason = new Models_Reason();
            $data['reason'] = $modelReason->getAll();
            
            $modelReasonDetail = new Models_Reason_Detail();
            $data['reasonDetail'] = $modelReasonDetail->getAll();
            
            $this->view->data = $data;
        }        
        catch(Exception $ex)
        {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    public function statisticAction()
    {}
    public function reasonAction()
    {}
    
    public static function create()
    {
        $mess['actTime'] = date('Y-m-d H:i:s');
        $mess['act'] = 0;
        $mess['actorAcc'] = 0;
        $mess['target'] = null;
        $mess['targetAcc'] = null;
        $mess['s1'] = null;
        $mess['s2'] = null;
        $mess['s3'] = null;
        $mess['s4'] = null;
        $mess['n1'] = null;
        $mess['n2'] = null;
        $mess['n3'] = null;
        $mess['n4'] = null;
        $mess['n5'] = null;
        $mess['n6'] = null;
        $mess['n7'] = null;
        $mess['n8'] = null;
        $mess['n9'] = null;
        $mess['n10'] = null;
        
        return $mess;
    }    
    public static function addCoinEvent($userId, $level, $total, $gold ,$xu, $userGender = null)
    {
        $mess = self::create();
        $mess['act'] = 175;
        $mess['actorAcc']     = $userId;        
        $mess['n7']         = $userGender;    
        $mess['n8']            = $level;
        $mess['n2']         = $total;        
        $mess['n5']         = 2;
        $mess['n10']         = $xu;
        $mess['n9']            = $gold;
        
        self::write($mess);
    }
    public static function write($mess, $category='log')
    {
        //return;
        try
        {
            //kiem tra neu trong data co dau | thi ko ghi log
            //vi ki tu | dung de phan cach cac field data
            foreach($mess as $key => $val)
            {
                if(strpos($val, '|') !== false)
                {
                    return;
                }
            }               
            $socket = new TSocket(LOG_SERVER, LOG_PORT, true);
            $transport = new TFramedTransport($socket);
            $protocol = new TBinaryProtocol($transport, false, false);
            $scribe_client = new scribeClient($protocol, $protocol);

            $transport->open();
            
            $msg['category'] = LOG_FOLDER;
            $msg['message'] = implode('|', $mess);

            $entry = new LogEntry($msg);

            $messages = array($entry);
            $scribe_client->Log($messages);

            $transport->close();
        }
        catch(Exception $ex)
        {
           
        }
    }
}
?>
