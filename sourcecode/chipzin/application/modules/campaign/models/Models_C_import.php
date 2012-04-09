<?php
require_once 'excel_reader.php';



class Models_C_import extends Models_Base {
	
		
	
	public function importMaps($filename, $row , $rowEnd) {
		
		$data = new Spreadsheet_Excel_Reader ( $filename, true, "UTF-8" ); // Ð?c file excel, h? tr? Unicode UTF-8
		//$data= new DOM_Logic($filename);
		$col = 1; //cột đang xét
		$test = 0; //biến kiểm tra
		$arr = null; //mảng lưu giá trị file excel
		$world = null; //mảng lưu world map đang xét
		$camp = null; //mảng lưu campaign
		

		//kiểm tra world map đầu tiên phải có
		if ($data->val ( $row, 0+1, 0 ) == null) {
			//$message = "Kiểm tra lại thông tin world map, trận đánh không thể không có world map ! ";
			return 1;
		}
		
		//var_dump($data->val ( $row, 1, 0 ));
		//die();
		
		//kiểm tra tên làng đầu tiên phải có
		if ($data->val ( $row, 1+1, 0 ) == null || $data->val ( $row, 2+1, 0 ) == null) {
			//$message = "Kiểm tra lại thông tin làng, thiếu thông tin tên campaign hoặc type map  ! ";
			return 2;
		}
		
		while ( $test < 20 ) {
			
			if ($row > $rowEnd)
				break;
			
		//lấy world map
			if ($data->val ( $row, 0+1, 0 ) != null) {
				$world = $data->val ( $row, 0+1, 0 );
				$arr [$world] = null;
			}
			
			//lấy campaign		
			if ($data->val ( $row, 1+1, 0 ) != null) {
				$camp = $data->val ( $row, 1+1, 0 );
				$arr [$world] [$camp] = null;
			}
			
			//lấy type map	
			if ($data->val ( $row, 2+1, 0 ) != null) {
				$arr [$world] [$camp] ['Type'] = $data->val ( $row, 2+1, 0 );
			}
			
			// kiểm tra tên battle
			if ($data->val ( $row, 3+1, 0 ) == null) {
				//var_dump($row."//".$data->val ( $row, 4, 0 ));
				//die();
				//kiểm tra layout
				if ($data->val ( $row, 4+1, 0 ) == null) {
					if ($data->val ( $row, 5+1, 0 ) == null && $data->val ( $row, 6+1, 0 ) == null && $data->val ( $row, 7+1, 0 ) == null && $data->val ( $row, 8+1, 0 ) == null && $data->val ( $row, 9+1, 0 ) == null) {
						$test = $test + 1;
						$row = $row + 1;
					} else {
						//$message = "Kiểm tra lại thông tin tên trận đánh, layout các trận đánh. Tất cả các vị trí không thể trống ! ";
						return 3;
					}
				
				} else {
					//$message = "Kiểm tra lại tên các trận đánh. Không thể không có tên trận đánh ! ";
					return 4;
				}
			
			} else if ($data->val ( $row, 4+1, 0 ) == null || ($data->val ( $row, 5+1, 0 ) == null && $data->val ( $row, 6+1, 0 ) == null && $data->val ( $row, 7+1, 0 ) == null && $data->val ( $row, 8+1, 0 ) == null && $data->val ( $row, 9+1, 0 ) == null)) {
				//$message = "Kiểm tra lại thông tin các trận đánh. Không thể không có layout hoặc tất cả các vị trí trống trong trận đánh ! ";
				return 5;
			} else {
				$arr [$world] [$camp] ['Battle'] [$data->val ( $row, 3+1, 0 )] ['layout'] = $data->val ( $row, 4+1 ,0 );
				
				$arr [$world] [$camp] ['Battle'] [$data->val ( $row, 3+1, 0 )] ['vt1'] = $data->val ( $row, 5+1, 0 );
				$arr [$world] [$camp] ['Battle'] [$data->val ( $row, 3+1, 0 )] ['vt2'] = $data->val ( $row, 6+1, 0 );
				$arr [$world] [$camp] ['Battle'] [$data->val ( $row, 3+1, 0 )] ['vt3'] = $data->val ( $row, 7+1, 0 );
				$arr [$world] [$camp] ['Battle'] [$data->val ( $row, 3+1, 0 )] ['vt4'] = $data->val ( $row, 8+1, 0 );
				$arr [$world] [$camp] ['Battle'] [$data->val ( $row, 3+1, 0 )] ['vt5'] = $data->val ( $row, 9+1, 0 );
				
				$row = $row + 1;
				$test = 0;
			}
		}
		
		return $arr;
	}
	
	public function importSoldier($filename) {
		$data = new Spreadsheet_Excel_Reader ( $filename, true, "UTF-8" ); // Ð?c file excel, h? tr? Unicode UTF-8
		$row = 2;
		$test = 0;
		$arr = null;
		while ( $test < 20 ) {
			
			if ($data->val ( $row, 1, 0 ) == null) {
				if ($data->val ( $row, 2, 0 ) == null) {
					$row = $row + 1;
					$test = $test + 1;
				} else {
					//$mess = 'Kiểm tra lại thông tin Soldier, Name không được bỏ trống';
					return 1;
				}
			} else {
				if ($data->val ( $row, 2, 0 ) == null) {
					//$mess = 'Kiểm tra lại thông tin Soldier, ID không được bỏ trống';
					return 2;
				} else {
					$arr [$data->val ( $row, 2, 0 )] = $data->val ( $row, 1, 0 );
					$row = $row + 1;
					$test = 0;
				}
			
			}
		}
		
		return $arr;
	}

	//public function importLayout($filename)
}