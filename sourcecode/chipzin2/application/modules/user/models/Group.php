<?php
class User_Model_Group extends Base_Model
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "group";		
	}
	
	public function getGroup()
	{
		$sql = "SELECT
					*
				FROM
					`group`
				WHERE
					id <> 1";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
}

?>
