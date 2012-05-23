<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
class Models_String2 extends Models_Base
{
	public function __construct()
	{
		parent::__construct();	
	}
	
	//////////////////ThaoNX//////////////////////
	public function getlanguage2()
	{
		$sql = "select * from l_language where status <> 1 ORDER BY status DESC";
		return $this->_db->fetchAll($sql);
	}
	
	public function getlangdefault2()
	{
		$sql = "select id,name from l_language where status = 1";
		$lang = $this->_db->fetchRow($sql, null, Zend_Db::FETCH_OBJ);
		return $lang;
	}
	
	public function getlangindex2()
	{
		$sql = "select id,name from l_language where status <> 1 ORDER BY status DESC";
		$lang = $this->_db->fetchRow($sql, null, Zend_Db::FETCH_OBJ);
		return $lang;
	}	
	public function updateindexlang2($id)
	{
		$sql = "UPDATE l_language SET status= 0 WHERE status <> 1;";
		$sql .="UPDATE l_language SET status= 2 WHERE id ='$id';";
		$stmt = $this->_db->query($sql);
		$result = $stmt->rowCount();
	}
	
	public function getCount2($content)
	{
		$sql = "select COUNT(id) from l_content where lang = (SELECT id from l_language WHERE status = 1)";
		if(isset($content->lgroup)&& !empty($content->lgroup)){
			$sql .= " AND l_content.lgroup = ".$content->lgroup;
		}
		if(isset($content->lkey)&& !empty($content->lkey)){
			$sql .= " AND l_content.lkey = ".$content->lkey;
		}
		
		if(isset($content->text)&& !empty($content->text)){
			$sql.= " AND  l_content.text like '%".$content->text."%' ";
		}
		$count = $this->_db->fetchONE($sql, null, Zend_Db::FETCH_OBJ);
		return $count;
	}
	
	public function filter2 ($content,$page,$size){
				$sql = "SELECT a.id as id,g.name as gname,g.id as gid,a.lkey as lkey,a.text as ldefault, b.text as lindex
				FROM l_content a 
				LEFT JOIN l_content b ON (a.lgroup=b.lgroup AND a.lkey=b.lkey AND b.lang = (SELECT id FROM l_language WHERE status<>1 ORDER BY l_language.status DESC LIMIT 0,1))
				LEFT JOIN l_group g ON (a.lgroup=g.id)
				WHERE a.lang = (SELECT id FROM l_language WHERE status=1)";
		
		//$content->text = htmlentities($content->text,ENT_QUOTES);
		//$content->text = htmlentities($content->text,ENT_NOQUOTES);
		
		if(isset($content->lgroup)&& !empty($content->lgroup)){
			$sql .= " AND a.lgroup = ".$content->lgroup;
		}
		if(isset($content->lkey)&& !empty($content->lkey)){
			$sql .= " AND a.lkey = ".$content->lkey;
		}		
		if(isset($content->text)&& !empty($content->text)){
			$sql.= " AND  a.text like '%".$content->text."%' ";
		}
		$sql .= " ORDER BY a.lkey DESC";
		
		if(isset($page) && !empty($page) && isset($size) && !empty($size)){
			$sql .= " LIMIT ".($page-1)*$size.",".$size;
		}
		
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		return $data;
	}

	public function getAllGroup2(){
		$sql = "SELECT * FROM l_group";
		$data = $this->_db->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
		return $data;
	}

	public function getTextBylang2($lang,$key,$groupid=null,$groupname=null){
		$sql = "SELECT text FROM l_content WHERE lang ='".$lang."' AND lkey = '".$key."'";
		if($groupid && !empty($groupid))
			$sql.=" AND lgroup = '".$groupid."'";
		if($groupname && !empty($groupname))
			$sql.=" AND lgroup = (SELECT id FROM l_group WHERE name='".$groupname."')";		
		$rs = $this->_db->fetchOne($sql);
		return $rs;
	}

	public function update2($content){		
		// default language
		//$content->ldefault = htmlentities($content->ldefault,ENT_QUOTES);
		$content->ldefault = htmlspecialchars($content->ldefault,ENT_QUOTES);
		$sql ="UPDATE l_content SET text='$content->ldefault' ";
		$where = " WHERE 1";
		if($content->lkey && !empty($content->lkey))
			$where.=" AND lkey = '".$content->lkey."'";	
		if($content->lgroup && !empty($content->lgroup))
			$where.=" AND lgroup = '".$content->lgroup."'";
			
		$sql.= $where." AND lang IN(SELECT id FROM l_language where status = 1)";
		
		$stmt = $this->_db->query($sql);
		$result = $stmt->rowCount();
		// index language
		$sql ="SELECT id FROM l_content ".$where." AND lang = (SELECT id FROM l_language where status <> 1 ORDER BY status DESC LIMIT 0,1)"; 
		$content_id = $this->_db->fetchOne($sql);
		$content->lindex = htmlspecialchars($content->lindex,ENT_QUOTES);		
		if($content_id==0){
			$sql ="INSERT l_content(lgroup,lkey,text,lang) VALUE(".$content->lgroup.",".$content->lkey.",'".$content->lindex."',"."(SELECT id FROM l_language where status <> 1 ORDER BY status DESC LIMIT 0,1)) ";			
		}else{
			$sql ="UPDATE l_content SET text='".$content->lindex."' WHERE 1 AND id=".$content_id; 			
		}
		$stmt = $this->_db->query($sql);
		$result = $stmt->rowCount();
		
		return $result;
		
	}	

	public function insert2($content){
		$data = Array('lkey'=>$content->lkey,'lgroup'=>$content->lgroup);
		$lang_default = $this->getlangdefault2();
		$data['lang']= $lang_default->id ;	
		$data['text']= $content->ldefault ;
		$id = 0;
		$sql="SELECT COUNT(id) FROM l_content WHERE lgroup=$content->lgroup AND lkey=$content->lkey AND lang='".$lang_default->id."'";
		$count = $this->_db->fetchOne($sql);
		if($count!=0){
			return 0;
		}
		if($this->_db->insert("l_content",$data))
			$id = $this->_db->lastInsertId();
		if(isset($content->lindex) && !empty($content->lindex)){
			$lang_index = $this->getlangindex2();
			$data['lang']= $lang_index->id ;	
			$data['text']= $content->lindex ;
			$this->_db->insert("l_content",$data);
		}			
		return $id;
	}

	public function delete2($item){
		$sql = "DELETE FROM l_content WHERE 1";
		if(isset($item->lgroup) && !empty($item->lgroup)){
			$sql .= " AND lgroup=".$item->lgroup;
		}
		if(isset($item->lkey) && !empty($item->lkey)){
			$sql .= " AND lkey=".$item->lkey;
		}
		$stmt = $this->_db->query($sql);
        $result = $stmt->rowCount();
		return $result;
	}

	public function getMaxKeyOfGroup($lgroup){
		$sql = "SELECT MAX(lkey) FROM l_content";
		if(isset($lgroup) && !empty($lgroup)){
			$sql .= " WHERE lgroup=".$lgroup;
		}
		$rs = $this->_db->fetchOne($sql);
		return $rs;
	}
}