<?php
class Models_String
{
	var $db;
	public function __construct()
	{
		$this->db = Zend_Registry::get("db");
	}
	public function updateReplace($id,$search, $replace)
	{
		$sql = "select text from l_content where id=".$id;
		$tam = $this->db->fetchRow($sql);
		$subject = $tam['text'];
		$subjectrs = str_replace($search, $replace, $subject);
		
		$where = "id=".$id;
		$data=array('text'=>$subjectrs);
		$this->db->update('l_content',$data,$where);
	}
	public function getDataByLangNopage($l_group,$id_s,$l_Search_type)
	{
		$text ="";
		if($l_group!=-1)
			$text .= " and l_content.lgroup=".$l_group." ";
		if($id_s!=-1)
			$text .= " and ".$l_Search_type." like'%".$id_s."%' ";
		
			$sql = "SELECT l_content.id,l_content.lgroup,l_content.lkey,l_content.text,l_group.name
					FROM l_group,l_content 
					WHERE   l_group.id=l_content.lgroup ".$text." 
					    	and lang in (select id from l_language where status = 1)"; 
		return $this->db->fetchAll($sql);
	}	
	public function getDataByLang($l_group,$page,$count,$id_s,$l_Search_type)
	{
		$text ="";
		if($l_group!=-1)
			$text .= " and l_content.lgroup=".$l_group." ";
		if($id_s!=-1)
			$text .= " and ".$l_Search_type." like'%".$id_s."%' ";
		
			$sql = "SELECT l_content.id,l_content.lgroup,l_content.lkey,l_content.text,l_group.name
					FROM l_group,l_content 
					WHERE   l_group.id=l_content.lgroup ".$text." 
					    	and lang in (select id from l_language where status = 1) 
					limit ".($page-1)*$count.",".$count;
		return $this->db->fetchAll($sql);
	}
	public function getGroup()
	{
		$sql = "select * from l_group";
		return $this->db->fetchAll($sql);
	}
	public function getGroupbyid($id)
	{
		$sql = "select name from l_group where id=".$id;
		$tam = $this->db->fetchRow($sql);
		return $tam['name'];
	}
	public function getlanguage()
	{
		$sql = "select * from l_language where status <> 1 ORDER BY `l_language`.`status` DESC";
		return $this->db->fetchAll($sql);
	}
	public function getlangdefault()
	{
		$sql = "select name from l_language where status = 1";
		$tam = $this->db->fetchRow($sql);
		return $tam['name'];
	}
	public function getlangindex()
	{
		$sql = "select name from l_language where status <> 1 ORDER BY `l_language`.`status` DESC";
		$tam = $this->db->fetchRow($sql);
		return $tam['name'];
	}
	public function getlangdefaultid()
	{
		$sql = "select id from l_language where status = 1";
		$tam = $this->db->fetchRow($sql);
		return $tam['id'];
	}
	public function getlangindexid()
	{
		$sql = "select id from l_language where status <> 1 ORDER BY `l_language`.`status` DESC";
		$tam = $this->db->fetchRow($sql);
		return $tam['id'];
	}
	public function getTextBylang($lang,$key,$group)
	{
		$sql = "select text from l_content where lang ='".$lang."' and lkey = '".$key."' and lgroup = ".$group;
		$rs = $this->db->fetchRow($sql);
		echo $rs['text'];
	}
	
	public function updateindexlang($id)
	{
		$where="status=2";
		$data=array('status'=>0);
		$this->db->update('l_language',$data,$where);
		$where="id='".$id."'";
		$data=array('status'=>2);
		$this->db->update('l_language',$data,$where);
	}
	public function DelBykeyAndGroup($key,$group)
	{
		$sql = 'delete l_content from l_content where lkey="'.$key.'" and lgroup='.$group;
		$this->db->query($sql);
	}
	public function generateId(){
		$sql = 'select lkey from l_content';
		$result = $this->db->fetchCol($sql);
		$bool=true;
		$count = 1;
		while ($bool == true){
			$count;
			if(!$this->checkid($count, $result)){
				$bool = false;
				return $count;				
			}
			$count++;
		}
		return $count;
	}
	public function checkid($id,$array){
		foreach ($array as $value) {
			if($value==$id){
				return true;
			}
		}
		return false;
	}	
	public function checkIdandGroup($key,$group)
	{
		$sql = "select id,lkey from l_content where lkey ='".$key."' and lgroup=".$group;
		$rs = $this->db->fetchRow($sql);
		if($rs['lkey']==$key)
			return false;
		else
			return true;
	}
	
	public function insert($key,$group,$text,$text1)
	{
		$sql = "select id from l_language where status = 1";
		$tam = $this->db->fetchRow($sql);
		$data = array(
					'lkey'=>$key,
					'lgroup'=>$group,
					'text'=>$text,
					'lang'=>$tam['id']
					);
		$this->db->insert('l_content',$data);
		$sql = "select id from l_language where status <> 1 ORDER BY `l_language`.`status` DESC";
		$tam2 = $this->db->fetchRow($sql);
		$data = array(
					'lkey'=>$key,
					'lgroup'=>$group,
					'text'=>$text1,
					'lang'=>$tam2['id']
					);
		$this->db->insert('l_content',$data);
		
		$sql = "select id from l_language";
		$tam3 = $this->db->fetchAll($sql);
		foreach ($tam3 as $vl)
		{
			if($vl['id']!=$tam2['id']&&$vl['id']!=$tam['id'])
			{
				$data = array(
					'lkey'=>$key,
					'lgroup'=>$group,
					'text'=>'',
					'lang'=>$vl['id']
					);
				$this->db->insert('l_content',$data);
				$sql = "select id from l_language where status = 1";
				$tam3 = $this->db->fetchAll($sql);
			}
		}
	}
	public function update($key,$group,$text,$text1)
	{
		$sql = "select id from l_language where status = 1";
		$tam = $this->db->fetchRow($sql);
		$where = "lkey = '".$key."' and lgroup=".$group." and lang = '".$tam['id']."'";
		$data = array(
					'text'=>$text
					);
		$this->db->update('l_content',$data,$where);
		
		$sql = "select id from l_language where status <> 1 ORDER BY `l_language`.`status` DESC";
		$tam2 = $this->db->fetchRow($sql);
		$where = "lkey = '".$key."' and lgroup=".$group." and lang = '".$tam2['id']."'";
		$data = array(
					'text'=>$text1
					);
		$this->db->update('l_content',$data,$where);
	}
	
	public function getid($idgroup)
	{
		$sql = "SELECT 
					(max(lkey) +1)
				FROM 
					l_content
				WHERE 
					lgroup = $idgroup";
		$rs = $this->db->fetchOne($sql);
		if($rs == "")
		{
			return 1;
		}
		return $rs;
	}
	
	public function getTextBylang2($lang,$key,$groupid=null,$groupname=null)
	{
		$sql = "SELECT text FROM l_content WHERE lang ='".$lang."' AND lkey = '".$key."'";
		if($groupid && !empty($groupid))
			$sql.=" AND lgroup = '".$groupid."'";
		if($groupname && !empty($groupname))
			$sql.=" AND lgroup = (SELECT id FROM l_group WHERE name='".$groupname."')";
		$rs = $this->db->fetchOne($sql);
		return $rs;
	}
	public function update2($key,$groupid=null,$groupname=null,$text,$text1)
	{
		// default language
		$sql ="UPDATE l_content SET text='$text' WHERE l_content.lang=(SELECT id FROM l_language where status = 1 ORDER BY status DESC LIMIT 1) AND lkey=$key";
		if($groupid && !empty($groupid))
			$sql.=" AND lgroup = '".$groupid."'";
		if($groupname && !empty($groupname))
			$sql.=" AND lgroup = (SELECT id FROM l_group WHERE name='".$groupname."')";
		$result= $this->db->query($sql);
		// index language
		$sql ="UPDATE l_content SET text='$text1' WHERE l_content.lang IN (SELECT id FROM l_language where status <> 1) AND lkey=$key";
		if($groupid && !empty($groupid))
			$sql.=" AND lgroup = '".$groupid."'";
		if($groupname && !empty($groupname))
			$sql.=" AND lgroup = (SELECT id FROM l_group WHERE name='".$groupname."')";
		$result= $this->db->query($sql);
	}
}
