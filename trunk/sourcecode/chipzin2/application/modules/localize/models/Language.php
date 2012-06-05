<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Localize_Language extends Models_Base
{
	public function __construct()
	{
		parent::__construct();
	}
	public function InsertGroup($name) {
		$data = array ('name' => $name);
		$this->_db->insert ( 'l_group', $data );
		return $this->_db->lastInsertId ();
	}
}
