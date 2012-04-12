<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_l_content extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "l_content";		
	}
	
	public function findname($id,$name)
	{
		$sql = "SELECT c.text 
				FROM l_content c, l_group g 
				WHERE c.lkey = '$id' AND g.`name` = '$name' AND c.lgroup = g.id";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function getGroupID($groupname)
	{
		$sql = "SELECT id 
				FROM l_group 
				WHERE name = '$groupname'";
		
		$data = $this->_db->fetchOne($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
}
?>
