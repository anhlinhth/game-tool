<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Item_Increment extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "id";
		$this->_table = "item_increment";		
	}
	
	public function getId()
	{
		$sql = "SELECT
					id
				FROM
					item_increment";
		
		$id = $this->_db->fetchOne($sql);
		
		return $id;
	}
	
	public function update($id)
	{
		$sql = "UPDATE
					item_increment
				SET
					id = '$id'";
		
		$this->_db->query($sql);
	}
}
?>
