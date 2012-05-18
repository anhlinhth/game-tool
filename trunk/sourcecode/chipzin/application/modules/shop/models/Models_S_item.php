<?php 
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_S_item extends Models_Base
{
public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_items";	
	}
public function insert($obj)
	{
		$sql = "INSERT INTO s_items(ID,Name,NameSV) 
				VALUES('$obj->ID','$obj->NameSV','$obj->NameSV')";
		
		$kq = $this->_db->query($sql);
		
		return $kq;
	}
	public function update($obj)
	{
		$sql = "UPDATE s_items 
				SET NameSV='$obj->NameSV'
				WHERE ID = '$obj->ID'";
		//print_r($sql);//die();
		$kq = $this->_db->query($sql);
		
		return $kq;
	}
	
	public function isexits($ID)
	{
		$sql = "SELECT
					ID
				FROM
					s_items
				WHERE
					ID = '$ID'";
		
		$id = $this->_db->fetchAll($sql);
		
		return $id;
	}
	
	public function hit($obj)
	{
		$id=$this->isexits($obj->ID);	
		//print_r($id);
 	if($id)
			return $this->update($obj);		
		else {
			return $this->insert($obj);
		}
	}
}
?>