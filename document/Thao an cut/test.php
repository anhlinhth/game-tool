<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>?n ?n Support</title>
</head>
<?php

$filename="Book3.xls";
require_once 'excel_reader2.php';
	$data = new Spreadsheet_Excel_Reader($filename,true,"UTF-8"); // Ð?c file excel, h? tr? Unicode UTF-8
	

$row = 2; //dòng dang xét
		
			$col = 1; //c?t dang xét
		$test = 0; //bi?n ki?m tra
		$arr = null; //m?ng luu giá tr? file excel
		$world = null; //m?ng luu world map dang xét
		$camp = null; //m?ng luu campaign
		$rowEnd=20;

		//ki?m tra world map d?u tiên ph?i có
		if ($data->val ( $row, 1, 0 ) == null) {
			$message = "Ki?m tra l?i thông tin world map, tr?n dánh không th? không có world map ! ";
			//echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('check file exits')</SCRIPT>");
			return ;
		}
		
		//ki?m tra tên làng d?u tiên ph?i có
		if ($data->val ( $row, 2, 0 ) == null ||$data->val ( $row, 3, 0 ) == null) {
			$message = "Ki?m tra l?i thông tin làng, thi?u thông tin tên campaign ho?c type map  ! ";
			return $message;
		}
		
		while ( $test<20 ) {
			
				if($row>$rowEnd)
				break;
				//l?y world map
				if ($data->val ( $row, 1, 0 ) != null) {
					$world = $data->val ( $row, 1, 0 );
					$arr [$world] = null;
				}
				
				//l?y campaign		
				if ($data->val ( $row, 2, 0 ) != null) {
					$camp = $data->val ( $row, 2, 0 );
					$arr [$world] [$camp] = null;
				}
			
				//l?y type map	
				if ($data->val ( $row, 3, 0 ) != null) {
					$arr [$world] [$camp]['Type'] = $data->val ( $row, 3, 0 );
				}
				
				// ki?m tra tên battle
				if ($data->val ( $row, 4, 0 ) == null) {
					
					//ki?m tra layout
					if ($data->val ( $row, 5, 0 ) == null) {
						if ($data->val ( $row, 6, 0 ) == null && $data->val ( $row, 7, 0 ) == null && $data->val ( $row, 8, 0 ) == null && $data->val ( $row, 9, 0 ) == null && $data->val ( $row, 10, 0 ) == null) {
							$test = $test + 1;
							$row = $row + 1;
						} else {
							$message = "Ki?m tra l?i thông tin tên tr?n dánh, layout các tr?n dánh. T?t c? các v? trí không th? tr?ng ! ";
							return $message;
						}
					
					} else {
						$message = "Ki?m tra l?i tên các tr?n dánh. Không th? không có tên tr?n dánh ! ";
						return $message;
					}
				
				} else if ($data->val ( $row, 5, 0 ) == null || ($data->val ( $row, 6, 0 ) == null && $data->val ( $row, 7, 0 ) == null && $data->val ( $row, 8, 0 ) == null && $data->val ( $row, 9, 0 ) == null && $data->val ( $row, 10, 0 ) == null)) {
					$message = "Ki?m tra l?i thông tin các tr?n dánh. Không th? không có layout ho?c t?t c? các v? trí tr?ng trong tr?n dánh ! ";
					return $message;
				} else {
					$arr [$world] [$camp]['Battle'][$data->val ( $row, 4, 0 )]['layout']=$data->val ( $row, 5, 0 );
					
					$arr [$world] [$camp]['Battle'][$data->val ( $row, 4, 0 )]['vt1']=$data->val ( $row, 6, 0 );
					$arr [$world] [$camp]['Battle'][$data->val ( $row, 4, 0 )]['vt2']=$data->val ( $row, 7, 0 );
					$arr [$world] [$camp]['Battle'][$data->val ( $row, 4, 0 )]['vt3']=$data->val ( $row, 8, 0 );
					$arr [$world] [$camp]['Battle'][$data->val ( $row, 4, 0 )]['vt4']=$data->val ( $row, 9, 0 );
					$arr [$world] [$camp]['Battle'][$data->val ( $row, 4, 0 )]['vt5']=$data->val ( $row, 10, 0 );
					
					$row = $row + 1;
					$test = 0;
				}
			}
		
		
	if($arr [0] [0]['Battle'][0]['vt5']!=null)
	die();
		var_dump($arr);
die();
		
	?>