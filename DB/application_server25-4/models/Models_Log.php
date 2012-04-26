<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Log.php';

class Models_Log extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "log";		
	}
	
	public static function insert($user,$action,$note=null)
	{
		$obj = new Obj_Log();
		$obj->action = $action;
		$obj->action_date = date("Y-m-d H:i:s");
		$obj->user = $user;
		$obj->note = $note;
		
		$data = Utility::transferObjectToArray($obj);
		
		$db = Zend_Registry::get("db");
		$db->insert('log', $data);
	}
	
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					log
				WHERE 1";
		
		if($objSearch->user)
			$sql .= " AND user = '$objSearch->user'";
		if($objSearch->action_date)
			$sql .= " AND DATE_FORMAT(action_date, '%Y-%m-%d') = '$objSearch->action_date'";
		
		if($order)
			$sql .= " ORDER BY $order";
		
		if($count > 0)
			$sql .= " LIMIT $offset, $count";
		
		$data = $this->_db->fetchAll($sql, "", Zend_db::FETCH_OBJ);
		
		return $data;
	}
	
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(id)
				FROM
					log
				WHERE 1";
		
		if($objSearch->user)
			$sql .= " AND user = '$objSearch->user'";
		if($objSearch->action_date)
			$sql .= " AND DATE_FORMAT(action_date, '%Y-%m-%d') = '$objSearch->action_date'";
		
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
}

?>
