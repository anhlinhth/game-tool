<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Quest_Award extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "q_award";		
	}
	
	public function delete($id)
	{
		$sql ="DELETE FROM
					q_award
				WHERE
					QuestID = $id";
		$this->_db->query($sql);
	}
	public function add($questID, $AwardTypeID, $Value)
	{
		$sql = "INSERT INTO
					q_award
				VALUES(NULL,$questID,$AwardTypeID,$Value)";
		$this->_db->query($sql);
	}
}
?>
