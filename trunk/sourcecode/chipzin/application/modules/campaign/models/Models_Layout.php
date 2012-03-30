<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Layout extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_layout";	
	}
	
	public function getLayout()
	{
		return parent::_filter();
	}
	public function getLayoutById($id)
	{
		$sql="
			SELECT
				 *
			FROM
				c_layout
			WHERE ID=$id		
		";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);	
		return $data;
	}
	public function insertLayout($obj)
	{
		parent::_insert($obj);
	}
	
	public function filter($objSearch,$order,$offset,$count)
	{
		$sql = "SELECT
					*
				FROM
					c_layout
				WHERE
					1";
		if($objSearch)
			$sql .= " AND Name LIKE '%$objSearch%'";
		if($objSearch)
			$sql .= " AND ID = '$objSearch'";
		if($order)
			$sql .= " ORDER BY $order";
	
		if($count > 0)
			$sql .= " LIMIT $offset,$count";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	public function update($id,$point,$Name)
	{
		$sql ="UPDATE
					c_layout
				SET
					Point = '$point', Name = '$Name'
				WHERE
					ID = $id;";
		$this->_db->query($sql);
	}
	public function delete($id)
	{
		parent::_delete($id);
	}
}
