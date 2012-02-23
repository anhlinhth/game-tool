<?php
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_Quest_Awarditem.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Quest_Awarditem extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "QuestID";
		$this->_table = "q_quest_awarditem";		
	}

}
?>
