<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Needquest.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Quest_Needquest extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "q_quest_needquest";		
	}
	/*
	public function updateItem($oldQuestID, $oldNeedQuest, $newQuestID, $newNeedQuest)
	{
		$sql ="	UPDATE 
					q_quest_needquest 
				SET 
					QuestID = `$newQuestID`, NeedQuest = `$oldNeedQuest`
				WHERE 
					QuestID = `$oldQuestID` AND NeedQuest = `$oldNeedQuest`";
		
		$data = $this->_db->fetchAll($sql);//($sql, "", Zend_Db::FETCH_OBJ);
    }*/
}
?>
