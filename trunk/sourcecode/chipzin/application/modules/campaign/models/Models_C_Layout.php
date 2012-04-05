<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_C_Layout extends Models_Base {
	public function __construct() {
		parent::__construct ();
		$this->_key = "ID";
		$this->_table = "c_layout";
	}
	
	public function getLayout($id) {
		$sql = "
			SELECT
				 *
			FROM
				c_layout
			WHERE ID='$id '";
		$data = $this->_db->fetchAll ( $sql, "", Zend_Db::FETCH_OBJ );
		return $data;
	}
	
	public function getPoint($id) {
		
		$mdlayout = new Models_C_Layout ();
		$layout = array ();
		$layout = $mdlayout->getLayout ( $id );
		$strPoint = $layout [0]->Point;
		$strPoint = substr ( $strPoint, 1, strlen ( $strPoint ) - 2 );
		$arrPoint = explode ( ',', $strPoint );
		$dem = 0;
		$arrP = array ();
		foreach ( $arrPoint as $key => $value ) {
			if ($value == 1) {
				$arrP [$dem] = $key;
				$dem = $dem + 1;
			}
		}
		return $arrP;
	}
	
	public function getAllLayout() {
		$sql = "
			SELECT
				 *
			FROM
				c_layout
			WHERE 1
				
		";
		$data = $this->_db->fetchAll ( $sql, "", Zend_Db::FETCH_OBJ );
	
		$kq=null;
		$dem=0;
		foreach ( $data as $a ) {
						
			$kq[$a->ID]=$this->getPoint($a->ID);
				
			$dem= $dem+1 ;
		}
	
	return $kq;
	
	
	}

}
