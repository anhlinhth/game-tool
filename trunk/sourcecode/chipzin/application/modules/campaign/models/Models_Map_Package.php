<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'Object'.DS.'Obj_Campaign.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Map_Package extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_campaign";		
	}
	
	public function insert($obj)
	{
		parent::_insert($obj);		
	}
	
	public function update($obj)
	{
		try{
		parent::_update($obj);}
		catch (Exception $e){echo $e;}
	}
	
	public function delete($id)
	{
		parent::_delete($id,null);
	}
	public function getdata()
	{
		$sql = "SELECT
					*
				FROM
					c_campaign";
		
		$data = $this->_db->fetchAll($sql);
		
		return $data;
	}
	public function getnextmap($id)
	{
		$sql = "SELECT
					*
				FROM
					c_nextcamp
				WHERE
					CampID='$id'";
		$data = $this->_db->fetchRow($sql);
		
		return $data;
	}
	public function generate($data)
	{
		$i = 1;
		$error = array();
		$data5 = $this->count();
		$str .= "<?php\nreturn array\n(\n";
		foreach ($data as $row)
		{
			if($row['TypeID']==1)
			{
				$str .= "\tMAP_".$row['ID']." => array \n ";
				$str .= "\t{\n";
				$str .= "\t\t'type' => MAP,  \n";
				$str .= "\t\t'name' => '".$row['Name']."',\n";
				$data1 = $this->fetchone($row['NeedCamp']);
				$data2 = $this->getnextmap($row['ID']);
				$data3 = $this->fetchone($data2['CampID']);
				if($row['NeedCamp']!=NULL)
				{
					if($data1['TypeID']==1)
						$str .= "\t\t'needmap' =>MAP_".$data1['ID'].",  \n";
					else 
				 		$str .= "\t\t'needmap' =>BARRACK_".$data1['ID'].",  \n";
				}
				else
					$str .= "\t\t'needmap' => NULL,  \n";
				if($data2!=NULL)
				{
					if($data3['TypeID']==1)
						$str .= "\t\t'nextmap' =>BARRACK_".$data2['NextCamp'].",  \n";
					else
						$str .= "\t\t'nextmap' =>MAP_".$data2['NextCamp'].",  \n";
				}
				else 
					$str .= "\t\t'nextmap' => NULL,\n";
				$str .= "\t\t'width' => 40, \n";
				$str .= "\t\t'height' => 40, \n";
				$str .= "\t\t'blocks' => array(), \n";
				$str .= "\t\t'freeWorker' => 0 \n";
				if($i<$data5)
					$str .= "\t},\n";
				else 
					$str .= "\t}\n";
			}
			else 
			{
			
	
			
				$str .= "\tBARRACK_$i=> array \n ";
				$str .= "\t{\n";
				$str .= "\t\t'type' => BARRACK, \n";
				$data1 = $this->fetchone($row['NeedCamp']);
				$data2 = $this->getnextmap($row['ID']);
				$data3 = $this->fetchone($data2['CampID']);
				
				if($row['NeedCamp']!=NULL)
				{
					if($data1['TypeID']==1)
						$str .= "\t\t'needmap' =>MAP_".$data1['ID'].",  \n";
					else 
				 		$str .= "\t\t'needmap' =>BARRACK_".$data1['ID'].",  \n";
				}
				else
					$str .= "\t\t'needmap' => NULL,  \n";
				if($data2!=NULL)
				{
					if($data3['TypeID']==1)
						$str .= "\t\t'nextmap' =>BARRACK_".$data2['NextCamp'].",  \n";
					else
						$str .= "\t\t'nextmap' =>MAP_".$data2['NextCamp'].",  \n";
				}
				else 
					$str .= "\t\t'nextmap' => NULL,\n";
					if($i<$data5)
					$str .= "\t},\n";
				else 
					$str .= "\t}\n";
				
			}
			$i++;
			}
			$str .= ");\n?>";
		if(empty($error)){
			$fp = fopen(MAP_PACKAGE_PHP_FILE, 'w');
			if(fwrite($fp, $str) === false)
			{
				fclose($fp);				
			}
		}else{
			return $error;
		}		
		
		
	}
		
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					c_campaign
				WHERE
					1";
		
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	
	}
	public function fetchone($id)
	{
		$sql = "SELECT
					*
				FROM
					c_campaign
				WHERE
					ID='$id'";
		
		$data = $this->_db->fetchRow($sql);
		
		return $data;
	}
	public function fetchname($objSearch)
	{
		$sql = "SELECT
					NAME
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";
		
		$data = $this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	
	}
	public function count()
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					c_campaign
				WHERE
					1";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public  function searchNext($objSearch)
	{
		$sql = "SELECT
					NextCamp
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public  function isExist($objSearch)
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					c_campaign
				WHERE
					ID='$objSearch'";
				
		$count = $this->_db->fetchOne($sql);
		
		return $count;
	}
	public function getQuestLine()
	{		
				
	}
	
public function getAllbattle()
	{
		$sql = "SELECT
					*
				FROM
					c_battle_soldier
				WHERE
					1";
		
		$data = $this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);
		
		return $data;
	
	}
}
?>