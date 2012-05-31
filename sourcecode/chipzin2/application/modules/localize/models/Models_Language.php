<?php
class Models_Language
{
	var $db;
	public function __construct()
	{
		$this->db = Zend_Registry::get("db");
	}
	
	public function getDataLanguage()
	{
		$sql = "select * from l_language";
		return $this->db->fetchAll($sql);
	}
	public function checkdel($id)
	{
		$sql = "select lang from l_content where lang ='".$id."'";
		$rs = $this->db->fetchRow($sql);
		if($rs['lang']==$id)
			return false;
		else
			return true;
	}
	public function checkstatus($status)
	{
		$sql = "select status from l_language where status ='".$status."'";
		$rs = $this->db->fetchAll($sql);
		if($rs[1]['status']==$status)
			return true;
		else
			return false;
	}
	public function DelById($id)
	{
		$sql = 'delete l_language from l_language where id="'.$id.'"';
		$this->db->query($sql);
	}
	public function insert($id,$name)
	{
		$data = array(
					'id'=>$id,
					'name'=>$name,
					'status'=>0
					);
		$this->db->insert('l_language',$data);
	}
	public function checkId($id)
	{
		$sql = "select id from l_language where id ='".$id."'";
		$rs = $this->db->fetchRow($sql);
		if($rs['id']==$id)
			return false;
		else
			return true;
	}
	public function update($id,$name)
	{
		$where="id='".$id."'";
		$data=array('name'=>$name);
		$this->db->update('l_language',$data,$where);
	}
	public function updatestatus($id,$status)
	{
		$where="id='".$id."'";
		$data=array('status'=>0);
		$this->db->update('l_language',$data,"1");
		$data=array('status'=>$status);
		$this->db->update('l_language',$data,$where);
	}
}
