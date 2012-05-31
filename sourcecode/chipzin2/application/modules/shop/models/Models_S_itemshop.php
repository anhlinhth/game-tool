<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_S_itemshop extends Models_Base
{
public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "s_itemshop";	
	}
public function insert($obj,$kind)
	{
		
		try{
		$sql= "SELECT ID 
		FROM s_type_kind
		 WHERE Name = '$kind'
		";
	$kindID=$this->_db->fetchOne($sql);
	$obj->Kind=$kindID;
	
	$id = $this->_insert($obj);
	
	return $id;
		}
		catch(Exception $e)
		{
			var_dump($sql);
			var_dump("\n");
			var_dump($obj);
		}
		
	}
	
	public function updateLevel($obj)
	{
		try{
		$data=array();
		if($obj->Level!=null)
		{
			$data['Level']=$obj->Level;
		}
		if($obj->pricePerLevel!=nulll)
		{
			$data['pricePerLevel']=$obj->pricePerLevel;
		}
		if($obj->NeedCamp!=null)
		{
			$data['NeedCamp']=$obj->NeedCamp;
		}
		
	$id = $this->_db->update('s_itemshop', $data, 'ID = '.$obj->ID);
	return $id;}
	catch(Exception $e)
	{
		print_r($obj);
		die();
	}
	}
	
	public function deleteall()
	{
	$sql="
		DELETE FROM `s_itemshop` WHERE 1;
ALTER TABLE s_itemshop AUTO_INCREMENT=1;
		";
		$kq=$this->_db->query($sql);
		return kq;
	}
	
	
public function getInfoItem($id)
	{
		$sql="
		SELECT *
		FROM s_itemshop
		WHERE ID=$id
		";
		
		return $this->_db->fetchAll($sql);
	}
	
	public function getAll()
	{
		$sql="
		SELECT *
		FROM s_itemshop
		WHERE 1
		ORDER BY ID
		";
		
		return $this->_db->fetchAll($sql);
	}
}