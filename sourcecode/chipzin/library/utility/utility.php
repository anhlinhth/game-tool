<?php
require_once 'Zend_Mail_InlineImages.php';
require_once ROOT_LIBRARY_UTILITY.DS.'excel_xml.php';

class Utility
{
	public static function log($msg, $file, $line)
	{
		if($fd = @fopen(LOG_FILE,"a+"))
		{
			fputs($fd,strftime("[%Y/%m/%d-%H:%M:%S]")."[$file:$line] ".$msg."\n");
			fclose($fd);
		}
	}

	public static function transferObjectToArray($obj)
	{
		$arrKey = array_keys((array)$obj);
		foreach($arrKey as $key)
		{
			if(!is_object($obj->$key))
				$data[$key] = $obj->$key;
		}

		return $data;
	}

	public static function transferArrayToObject($data, $obj)
	{
		$arrKey = array_keys((array)$obj);
		foreach($arrKey as $key)
		{
			$obj->$key = $data[$key];
		}

		return $obj;
	}

	public static function fireLog($x)
	{
		$logger = Zend_Registry::get('logger');
		$logger->log($x, Zend_Log::INFO);
	}

	public static function readFile($filePath)
	{
		$handle = fopen($filePath, "rb");
		$content = fread($handle, filesize($filePath));
		fclose($handle);

		return $content;
	}

	public static function convertToPercent(&$datasets)
	{
		for($i = 0; $i < count($datasets); $i++)
		{
			$total = array_sum($datasets[$i]);

			for($j = 0; $j < count($datasets[$i]); $j++)
			{
				$datasets[$i][$j] = $datasets[$i][$j] / $total * 100;
			}
		}
	}

	public static function reduceCategories(&$categories)
	{
		for($i = 0; $i < count($categories); $i++)
		{
			$array =  explode("-", $categories[$i]);
			$categories[$i] = $array[0];
		}
	}

	public static function exportExcelCommon($output,$colName1,$header)
	{
		$size=count($output);
		$arrTmp=array();
		$header = explode(",", $header);
		$arrDate = array();
		$datasets = array();
		$excel = new excel_xml();
		$header_style = array(
			'bold' 		=> 1,
			'size'		=> '12',
			'color'		=> '#FFFFFF',
			'bgcolor'	=> '#4F81BD'
		);
		$excel->add_style("header", $header_style);

		if($size>0)
		{
			$arrTmp=$output[0];

			//tao header
			/*for($i = 1; $i <= $size; $i++)
			{
				array_push($header, "Điều kiện " . $i);
			}*/
			array_splice($header, 0,0,$colName1);
			$excel->add_row($header, 'header');
			//end header

			foreach ($arrTmp as $dt)
			{
			  array_push($arrDate, $dt->chartLabel);
			}

			$numOfRow = count($arrDate);

			//var_dump($output);
			for($i = 0; $i < $numOfRow; $i++)
			{
				$rowstr="";
				$rowstr .= $arrDate[$i].";";
				foreach($output as $row)
				{
					$rowstr .=$row[$i]->chartValue .";";
				}
				$excel->add_row($rowstr);
			}
		}

		$excel->create_worksheet("Report");
		$fileName = date('d-m-Y') . "_Report.xls";
		$excel->download($fileName);
	}

	public static function exportExcel($output, $name)
	{
		$excel = new excel_xml();
		$header_style = array(
			'bold' 		=> 1,
			'size'		=> '12',
			'color'		=> '#FFFFFF',
			'bgcolor'	=> '#4F81BD'
		);
		$excel->add_style("header", $header_style);

		$header = array(" ");
		$numCondition = count($output["datasets"]);
		for($i = 0; $i < $numCondition; $i++)
		{
			if($name[$i] == "")
			{
				$name[$i] = "Điều kiện " . ($i + 1);
			}

			array_push($header, $name[$i]);
		}
		$excel->add_row($header, 'header');

		for($i = 0; $i < count($output["categories"]); $i++)
		{
			$row = $output["categories"][$i] . ";";
			for($j = 0; $j < $numCondition; $j++)
			{
				if($output["datasets"][$j][$i])
				{
					$output["datasets"][$j][$i] = str_replace(",", "", $output["datasets"][$j][$i]);
				}
				else
				{
					$output["datasets"][$j][$i] = 0;
				}
				$row .= $output["datasets"][$j][$i] . ";";
			}
			$excel->add_row($row);
		}

		$excel->create_worksheet("Report");

		$fileName = date('d-m-Y') . "_Report.xls";

		$excel->download($fileName);
	}

	public static function exportTableToExcel($keys, $output, $headers)
	{
		$excel = new excel_xml();
		$header_style = array(
			'bold' 		=> 1,
			'size'		=> '12',
			'color'		=> '#FFFFFF',
			'bgcolor'	=> '#4F81BD'
		);
		$excel->add_style("header", $header_style);
		$excel->add_row($headers, 'header');

		for($i = 0; $i < count($output); $i++)
		{
			$row = "";
			for($j = 0; $j < count($keys); $j++)
			{
				$output[$i][$keys[$j]] = str_replace(",", "", $output[$i][$keys[$j]]);
				$row .= $output[$i][$keys[$j]] . ";";
			}
			$excel->add_row($row);
		}

		$excel->create_worksheet("Report");

		$fileName = date('d-m-Y') . "_Report.xls";

		$excel->download($fileName);
	}

	public static function getDayOfMonth($year, $month)
	{
		$dayOfMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if($year % 100 != 0 && $year % 4 == 0)
		{
			$dayOfMonth[1] = 29;
		}
		return $dayOfMonth[$month-1];
	}

	public static function sendSMTP($data, $template, $params = null)
	{
		$myview = new Zend_View();
		$myview->setScriptPath(ROOT_APPLICATION_VIEWS_LAYOUTS_EMAILS);
		if($params)
		{
			$myview->assign("params", $params);
		}
		$data['body'] = $myview->render($template);

		$transport = new Zend_Mail_Transport_Smtp('10.30.21.10', array('port' => 25));
		$mail = new Zend_Mail_InlineImages('utf-8');
		$mail->setFrom($data['fmail'], $data['fname']);
		$mail->addTo($data['tmail'], $data['tname']);
		$mail->setSubject($data['subject']);
		$mail->setBodyHtml($data['body'], 'UTF-8', Zend_Mime::MULTIPART_RELATED);
		$mail->buildHtml();
		$mail->send($transport);
	}
	
	public static function initMembase()
	{
		if(class_exists('Memcache')) 
			$dbInstance = new Memcache();
		else 
		{		
			throw new Internal_Error_Exception("PHP Class 'Memcache' does not exist!");			
		}

		$dbInstance->addServer(MEMBASE_ADDRESS,MEMBASE_PORT);
		
		return $dbInstance;
	}
	
	public static function initMemCache()
	{
		if(class_exists('Memcache')) 
			$dbInstance = new Memcache();
		else 
		{		
			throw new Internal_Error_Exception("PHP Class 'Memcache' does not exist!");			
		}

		$dbInstance->addServer(MEMCACHE_ADDRESS,MEMCACHE_PORT);
		
		return $dbInstance;
	}
	
	public static function validateCsvFile($name, $path)
	{
		$ext = strtolower(pathinfo($name['name'],PATHINFO_EXTENSION));
		
		switch ($ext)
		{
			case 'csv':
				break;
			default :
				$message = "file";
				return $message;
		}
		
		$destFile = $path.DS.$name['name'];
		$ret = move_uploaded_file($name['tmp_name'], $destFile);
		chmod($destFile, 0777);
		if($ret === false)
		{
			$message = "move";
			return $message;
		}
		
		return $name['name'];
	}
    
    public static function validateFile( $file )
    {
        
        $ext = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );  
        switch ( $ext )
        {
            case 'jpg' :
            case 'png' :
            case 'txt' :
                $message = true;
                break;
            default :
                $message = false ;
        }
        
        return $message;   
    }
	
	public static function getPigNameDefault()
	{
		return array('Ái Chà','Bạc Hà','Bận Rộn','Bảnh Bao','Bắp Rang','Bé Bỏng','Bé Con','Bé Heo','Bé Nấm',
        'Bé Xíu','Bé Bự','Béo Múp','Bí Đao','Bí Đỏ','Bí Ngô','Bọ Xít','Bờm','Bòn Bon','Bong Bóng','Bực Mình',
        'Bùm Chéo','Bụng Phệ','Buồn Linh Tinh','Buồn Man Mác','Buồn Vu Vơ','Burin','Cà Chua','Cà Phê','Cà Rốt',
        'Càm Ràm','Cằn Nhằn','Cau Có','Cáu Kỉnh','Càu Nhàu','Chả Thèm','Chíp','Chôm Chôm','Chuối Cau','Chuối Hột',
        'CoCa','Củ Cải','Cướp Biển','Dâu Tây','Dễ Thương','Điệu Chảy Nước','Điệu Đàng','Điệu Một Tí','Điệu Quá Xá',
        'Điệu Sơ Sơ','Điệu Vừa Vừa','Đô Đô','Đô La','Đói Bụng','Donut','Đu Đủ','Dưa Bở','Dưa Gang','Dưa Hấu',
        'Dừa Nước','Đủng Đà','Đủng Đỉnh','Duyên Dáng','E Lệ','Gấu Trúc','Hạt Tiêu','Heo Lười','Hêu','Hì Hì','Hí Hửng',
        'Hiệp Sĩ','Hột Mít','Kem','Khò Khò','Khoai Lang','Khoai Mì','Khoai Môn','Khoai Tây','Khóc Nhè','Khôn Khéo','Kỹ Tính',
        'Lãng Mạn','Lãng Tử','Lanh Lợi','Lật Đật','Lém Lỉnh','Lí Lắc','Lơ Ngơ','Loè Loẹt','Lồi Rốn','Lườm Lườm','Mắc Cỡ',
        'Măm Măm','Mắt Hí','Mật Ngọt','Mê Ngủ','Mê Sữa','Mệt Mỏi','Mít Đặc','Mơ Màng','Mộng Mơ','Moon','Mọt Sách','Mũm Mĩm',
        'Nấm Lùn','Ngái Ngủ','Ngáp Ruồi','Ngoan Lắm','Nhăn Nhó','Nhân Sâm','Nhanh Nhảu','Nheo Mắt','Nhí Nhảnh','Nhí Nhố',
        'Nhỏ Nhắn','Nho Xanh','Nhóc Buồn','Nhu Mì','Nước Đường','Ơ Rô','Ốc Tiêu','Panda','Pépsi','Phát Ngấy','Phong Cách',
        'Quýt Đường','Răng Chuột','Ranh Mãnh','Rụt Rè','Sợ Đủ Thứ','Sơri','Su Su','Sữa','Sún Răng','Tận Tình','Táo','Thận Trọng',
        'Thanh Long','Thế À','Thích Đủ Thứ','Thịt Mỡ','Tí Còi','Tí Đô','Ti Hí','Tí Hon','Tí Te','Tinh Nghịch','Tít',
        'To Gan','Tò Te','Tồ Tẹt','Tò Tí Te','Tồ Tồ','Toe Toét','Tốt Bụng','Tròn Vo','Tròn Xoay','Trùm','Trùm Sò',
        'Tũn','Ừ Nhỉ','Ủn Ỉn','Vàng Hoe','Vờ Vĩnh','Voi Còi','Vú Sữa','Vui Vẻ','Xá Xị','Xí Muội','Xì Tin','Xì Trum',
        'Xí Xọn','Xinh Xinh','Xương Rồng');
	}
	
	public static function getControllerNames()
	{
		return array('UserController',
					'ToolController',
					'GroupController',
					'EventController',
					'ShopeditorController',
					'GiftController',
                    'CompensationController');
	}
	
	public static function getLanguage($controller)
	{	
		$controller->view->langData = new Zend_Translate('csv', ROOT_LANGUAGE.DS."language.csv");		
	}
	
	public static function checkPrivilege($view, $controllerName, $actionName)
	{
		if($view->user->group_id == 1)
			return 1;
		
		if(is_array($view->user->groupPrivileges))
		{
			foreach($view->user->groupPrivileges as $privilege)
			{
				if($privilege['controller'] == $controllerName && $privilege['action'] == $actionName)
					return 1;
			}
		}
		
		return 0;
	}
    
    // dinhlhn create 25/8/2011
    // utils 

    public static function curPageURL()
    {
        $pageURL = "http://";
        
        if($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        
        return $pageURL;
    }

    public static function setPermission($path, $filemode)
    {
        if (!is_dir($path))
            return chmod($path, 0777);

        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if($file != '.' && $file != '..') {
                $fullpath = $path.'/'.$file;
                if(is_link($fullpath))
                    return FALSE;
                elseif(!is_dir($fullpath) && !chmod($fullpath, 0777))
                        return FALSE;
                elseif(!chmodr($fullpath, 0777))
                    return FALSE;
            }
        }

        closedir($dh);

        if(chmod($path, 0777))
            return TRUE;
        else
            return FALSE;
    }

    public static function openXML($path)
    {
        $xmlDoc = new DOMDocument();
        $xmlDoc->preserveWhiteSpace = false;
        $xmlDoc->formatOutput = true;
        $xmlDoc->load($path);
        return $xmlDoc;
    }
	
	/**
	 *
	 * @param type Path to folder contain bat file
	 * @return type 
	 */
	public static function syncData($location)
	{	
		if(!IS_SYNC)
			return;
		
		if($location == DEV)
		{
			Utility::runCMD(TRANSFER_BAT_DEV);			
			Utility::showOutput();
		}
		elseif($location == LIVE)
		{
			Utility::runCMD(TRANSFER_BAT_LIVE);				
			Utility::showOutput();
		}
		
		Utility::removeDir(ROOT_FILE);
	}
    
    public static function syncDataConfig()
    {    
        exec(TRANSFER_CONFIG_BAT);  		
        Utility::removeDir(ROOT_UPLOADCONFIG);
        Utility::removeDir(ROOT_UPLOADXML);
    }
	
	//Hinh anh popup
	public static function syncImage($location)
	{
		if(!IS_SYNC)
			return;		
		
		if($location == DEV)
			exec(TRANSFER_IMG_BAT_DEV);	
		if($location == LIVE)
			exec(TRANSFER_IMG_BAT_LIVE);			
	}
	
	//Hinh anh item goi qua
	public static function syncItemGiftImage($location)
	{
		if(!IS_SYNC)
			return;		
		
		if($location == DEV)
			exec(TRANSFER_ITEMGIFT_IMG_BAT_DEV);	
		if($location == LIVE)
			exec(TRANSFER_ITEMGIFT_IMG_BAT_LIVE);		
	}
	
	public static function removeDir($dir)
	{
		$dir_handle = opendir ($dir);
		if(!$dir_handle)
			return false;
		
		while($file = readdir($dir_handle))
		{
			if($file == "." || $file == "..")
				continue;
			
			if(!is_dir($dir."/".$file))
				unlink ($dir."/".$file);
			else
				Utility::removeDir ($dir."/".$file);
		}
		
		closedir();
	}
	public static function getCategories($data)
	{
		$categories = array();

		for($i = 0; $i < count($data[0]); $i++)
		{
			array_push($categories, $data[0][$i]["Key"]);
		}

		return $categories;
	}	
	
	public static function runCMD($command)
	{
		$outputfile = 'out.txt';
		
		$command .= ">>".$outputfile;
		
		system($command);

	}
	
	public static function showOutput()
	{
		$outputfile = 'out.txt';
		$arrContent = file($outputfile);
		
		unlink($outputfile);
		
		if(count($arrContent) > 0)
		{
			foreach($arrContent as $msg)
			{
				echo "$msg<br/>";
			}
		}
	}
	
}
?>