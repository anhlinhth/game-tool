<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localite'.DS.'models'.DS.'Group.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localite'.DS.'models'.DS.'Models_Export.php';

class Models_Localite_Iefile extends Models_Base
{
	public function __construct()
	{
		parent::__construct();
	}
	public function WriteFile($array,$filename){
		$export = new Models_Export();
		$mgroup = new Models_Localite_Group();
		$file=fopen($filename, "w");
		foreach ($array as $value) {
			$ginfo = $mgroup->GetGroupInfo($value['lgroup']);
		//	echo $export->ExportText($value['lgroup'], $value['lkey'], $value['lang']);
			//$substr = $this->Replacekeyintext($value['text'], $value['lang']);
			$stri = $export->ExportText($value['lgroup'], $value['lkey'], $value['lang']);
			fwrite($file,$stri . "\r\n");
		}
		fclose($file);
	}
	///////////////////
	

	public function gettextbykey($lang,$key)
	{
		$tam = split('#', $key);
		
		$sql = "select id from l_group where name='".$tam[0]."'";
		$tam1 = $this->db->fetchRow($sql);
		
		$sql = "select text from l_content where lang = '".$lang."' and lkey = '".$tam[1]."' and lgroup = ".$tam1['id'];
		$rs = $this->db->fetchRow($sql);
		if(isset($rs['text']))
			return $rs['text'];
		else 
			return "{@".$key."}";
		
	}
	public function Replacekeyintext($text,$lang)
	{
		$tam = split("{@", $text);
		$rs = "";
		$rs.=$tam[0];
		$i=0;
		foreach ($tam as $vl)
		{
			if($i>0)
			{
				$tam1 = split('}', $vl);
				$rs.=$this->gettextbykey($lang,$tam1[0]);
				$j=0;
				foreach ($tam1 as $vl1)
				{
					if($j>0)
					{
						if($j==1)
							$rs.=$vl1;
						else
							$rs.="}".$vl1;
					}
					$j++;
				}
			}
			$i++;
		}
		return $rs;
	}
	
	////////////////////////////
	public function GetAllLanguage(){
		$sql = 'select * from l_language';
		return $this->_db->fetchAll($sql);
	}
	public function GetAllContentByLang($lang){
		$sql = 'select * from l_content where lang="'.$lang.'"';
		return $this->_db->fetchAll($sql);
	}
	public function read_text_file($in_filename) {
	    $file = fopen($in_filename, 'r');
	    $output = array();
	    while (!feof($file)) {
	        $buf = fgets($file);
	        $output[] = $buf;
	    }
	    fclose($file);
	    return $output;
	}  
	public function curentday(){
		$today = getdate();
		$str = $today['year'].'-'. $today['mon'].'-'. $today['mday'].' '.$today['hours'].'-'. $today['minutes'].'-'. $today['seconds'];
		return $str;
	}
	public function ImportFile($array,$lang){
		$mgroup = new  Models_Localite_Group();
	//	echo '<pre>';
		foreach ($array as $value) {
			$content = $this->splitArray($value);
			if(isset($content['group'])&&$content['group']!=''&&$content['group']!=' ')
				try {
					if($mgroup->CheckExistGroup($content['group']) == false){
						$gid = $mgroup->InsertGroup($content['group']);
					}
					$gid = $mgroup->GetGroupIdByName($content['group']);
					if($this->CheckExistContent($content['key'], $gid, $lang) == false && $content['key']!='' && $content['key']!=' ')
						$cid =$this->InsertContent($content['key'], $gid, $lang, $content['content']);
				} catch (Exception $e) {
				}
		}
	}
	public function splitArray($str){
		$str = ltrim($str);
		$str = rtrim($str);
		$result = array();		
		if($str!='' && $str!=' ')
			$array1 = explode('=', $str);
			$array2 = explode('#', $array1[0]);
			$group = str_replace('@', '', $array2[0]);
			$result = array(
			'group' => $group,
			'key' => $array2[1],
			'content' => $array1[1]
			);
		return $result;
	}

	public function InsertContent($key,$group,$lang,$text) {		
		$data = array (
		'lkey' => $key,
		'lgroup' => $group,
		'lang' => $lang,
		'text' => $text
		);
		$this->_db->insert ( 'l_content', $data );
		return $this->_db->lastInsertId ();
	}
	public function CheckExistContent($key,$group,$lang){
		$sql = 'select * from l_content where lkey='.$key.' and lgroup='.$group.' and lang="'.$lang.'"';
		$result = $this->_db->fetchAll($sql);
		if(count($result)>0)return true;
		return false;
	}
}
