<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Quest extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "QuestID";
		$this->_table = "q_quest";		
	}
	
	public function getQuest()
	{
		$sql = "SELECT
					*
				FROM
					q_quest";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function getQuestlineID()
	{
		$sql = "SELECT DISTINCT
					QuestLineID,QuestLineName
				FROM
					q_questline";
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					q_quest
				WHERE
					1";
		
		if($objSearch->QuestID)
			$sql .= " AND QuestID LIKE '%$objSearch->QuestID%'";
		
		if($objSearch->QuestName)
			$sql .= " AND QuestName = '$objSearch->QuestName'";
		
		if($objSearch->QuestLineID)
			$sql .= " AND QuestLineID = '$objSearch->QuestLineID'";
		
		if($order)
			$sql .= " ORDER BY $order";
		
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;		
	}
	
	public function count($objSearch)
	{
		$sql = "SELECT
					COUNT(QuestID)
				FROM
					q_quest
				WHERE
					1";
		
		if($objSearch->ID)
			$sql .= " AND QuestID LIKE '%$objSearch->QuestID%'";
		
		if($objSearch->QuestName)
			$sql .= " AND QuestName = '$objSearch->QuestName'";
		
		if($objSearch->QuestLineID)
			$sql .= " AND QuestLineID = '$objSearch->QuestLineID'";
		
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
}
?>