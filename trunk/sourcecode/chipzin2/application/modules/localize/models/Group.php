<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';
// require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Localize_Model_Group extends Base_Model
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
	public function UpdateGroup($id,$name) {
		$where  = 'id='.$id;
		$data = array ('name' => $name);
		$this->_db->update ( 'l_group', $data ,$where);
		return $this->_db->lastInsertId ();
	}
	public function GetAllGroup(){
		$sql = 'select * from l_group';
		return $this->_db->fetchAll($sql);
	}
	public function GetGroupIdByName($name){
		$sql = 'select * from l_group where name="'.$name.'"';
		$result =  $this->_db->fetchRow($sql);
		return $result['id'];
	}
	public function GetGroupInfo($id){
		$sql = 'select * from l_group where id='.$id;
		return $this->_db->fetchRow($sql);
	}
	public function CheckExistGroup($name){
		$sql = 'select * from l_group where name="'.$name.'"';
		$result = $this->_db->fetchAll($sql);
		if(count($result)>0)return true;
		return false;
	}
	public function CheckExistGroupById($id){
		$sql = 'select * from l_group where id="'.$id.'"';
		$result = $this->_db->fetchAll($sql);
		if(count($result)>0)return true;
		return false;
	}
	public function deleteGroup($id){
		$where = "id='".$id."'";
		$this->_db->delete('l_group',$where);
	}
}
