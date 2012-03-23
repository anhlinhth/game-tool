<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Award_Type extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_award_type";	
	}
	
	public function getAwardtype()
	{
		return parent::_filter();
	}
	
	public function insertAward($name)
	{
		$sql="INSERT INTO
				c_award_type
			VALUES(NULL,'$name');";
		
		$this->_db->query($sql);
		
		$sqlselect ="	SELECT 
							*
						FROM
							c_award_type
						WHERE
							AwardTypeID = (SELECT MAX(AwardTypeID) 
											FROM 
												c_award_type);";
		
		$data=$this->_db->fetchAll($sqlselect,null,Zend_Db::FETCH_OBJ);
		return $data;
	}
}
