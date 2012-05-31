<?php
class Localize_Model_Export 
{
	var $db;
	public function __construct()
	{
		$this->db = Zend_Registry::get("db");
	}
	public function gettextbykey($lang,$key)
	{
		$tam = split('#', $key);
		if(count($tam)<2)
			return "";
		$sql = "select id from l_group where name='".$tam[0]."'";
		$tam1 = $this->db->fetchRow($sql);
		
		$sql = "select text from l_content where lang = '".$lang."' and lkey = '".$tam[1]."' and lgroup = ".$tam1['id'];
		$rs = $this->db->fetchRow($sql);
		if(isset($rs['text']))
			return htmlspecialchars_decode($rs['text']);
		else 
			return "{@".$key."}";
		
	}
	public function Replacekeyintext($text,$lang)
	{
		$text = htmlspecialchars_decode($text,ENT_QUOTES);
		$tam = explode('{@', $text);
		$rs = "";
		$rs.=$tam[0];
		$i=0;
		foreach ($tam as $vl)
		{
			if($i>0)
			{
				$tam1 = explode('}', $vl);
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
	public function ExportText($group,$key,$lang)
	{
		$sql = "select name from l_group where id=".$group;
		$tam = $this->db->fetchRow($sql);
		$sql="select text from l_content where lang='".$lang."' and lkey='".$key."' and lgroup =".$group;
		$rs = $this->db->fetchRow($sql);
		return "@".$tam['name'].'#'.$key.'='.$this->Replacekeyintext($rs['text'], $lang);
	}
}
