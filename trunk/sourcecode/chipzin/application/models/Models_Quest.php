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
	public function getNeedQuest()
	{
		$sql="
			SELECT DISTINCT
				NeedQuest,QuestLineID,QuestName
			FROM
				q_quest
				
			 ";
		$data=$this->_db->fetchAll($sql,null,Zend_Db::FETCH_OBJ);
		return $data;
	}
	public function updateNeedquest($id,$needquest)
	{
		$sql="
				UPDATE 
					q_quest
				SET
					NeedQuest ='".$needquest."'
				WHERE 
					QuestID='".$id."';
				
				UPDATE 
					q_NextQuest
				SET
					NextQuest = NULL
				WHERE 
					QuestID = '$id' AND NextQuest = '$needquest'; 	
					
			";
		//print_r($sql);
		$data=$this->_db->query($sql);
		return $data;
	}
	
	public function updateNextquest($id,$nextquest)
	{
// 		$sql="
// 				UPDATE 
// 					q_quest
// 				SET
// 					NextQuest = $nextquest
// 				WHERE 
// 					QuestID='".$id."'
// 			";
// 		$data=$this->_db->query($sql);
		$data = ("Not implement");
		return $data;
	}
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					Q.NeedQuest,Q.QuestID,Q.QuestName,QL.QuestLineID,QL.QuestLineName
				FROM
					q_quest as Q, q_questline as QL
				WHERE
					1 AND Q.QuestLineID = QL.QuestLineID";
		
		if($objSearch->QuestID)
			$sql .= " AND Q.QuestID = '$objSearch->QuestID'";
		
		if($objSearch->QuestName)
			$sql .= " AND Q.QuestName = '$objSearch->QuestName'";
		
		if($objSearch->QuestLineID)
			$sql .= " AND Q.QuestLineID = '$objSearch->QuestLineID'";
		
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
		
		if($objSearch->QuestName)
			$sql .= " AND QuestName = '$objSearch->QuestName'";
		
		if($objSearch->QuestLineID)
			$sql .= " AND QuestLineID = '$objSearch->QuestLineID'";
		
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	
	public function delete($value)
	{
		try
		{
	        $sql = "
	        		DELETE FROM
						q_nextquest
					WHERE 
						questID='$value';

				 	DELETE FROM
						q_award
					WHERE 
						questID='$value';
						
					UPDATE
	        			q_nextquest
	        		SET
	        			NextQuest = NULL
	        		WHERE
	        			NextQuest = '$value';	        			
	        		
	        		UPDATE
	        			q_quest
	        		SET
	        			NeedQuest = NULL
	        		WHERE
	        			NeedQuest = '$value';
	        			
	        		DELETE FROM 
	        			q_quest_awarditem
	        		WHERE
	        			QuestID = '$value';
	        			
	        		DELETE FROM
						q_task_target
					WHERE
						TaskID IN(SELECT TaskID FROM q_task WHERE QuestID = $value);
						
						
        			DELETE FROM         			
	        			q_task 
	        		WHERE
	        			QuestID = '$value';
	        			
	        		DELETE FROM
        				q_quest
	        		WHERE
	        			QuestID='$value';";
	      	
	        $temp = $this->_db->query($sql);
	        $result = $temp->rowCount();
    	}
    	catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}
    }
	public  function  getMaxQuestID()
	{
		$sql="SELECT
			 MAX(QuestID) 
			 FROM 
			 q_quest
			 ";
		$maxId=$this->_db->fetchOne($sql);
		return $maxId;
	}
}
?>
