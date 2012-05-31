<?php
class Base_Model
{
	protected $_key = null;
	
	protected $_table = null;
	
	/**
	 * 
	 * Db object for syndb
	 * @var Zend_Db_Adapter_Abstract
	 */
	protected $_db;	
	
	public function __construct()
	{
		$this->_db = Zend_Registry::get("db");
	}
	
	public function _insert($obj)
	{
		try
		{
			$data = Utility::transferObjectToArray($obj);
    		$this->_db->insert($this->_table, $data);
    		$id = $this->_db->lastInsertId();

    		return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}	
	
	public function _update($obj)
	{
		try
		{
			$data = Utility::transferObjectToArray($obj);
			$key = $data[$this->_key];
			unset($data[$this->_key]);			
			$this->_db->update($this->_table, $data, "$this->_key = $key");

    		return $key;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}    	
    }

	public function _delete($value, $section = null)
	{
		try
		{
			if(null != $section)
				$this->_db->delete($this->_table, "$section = '$value'");
			else
				$this->_db->delete($this->_table, "$this->_key = '$value'");
    	}
    	catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}
    }

	public function _getByKey($value)
	{
		try
		{
			$sql = "SELECT
						*
					FROM
						`$this->_table`
					WHERE
						$this->_key = '$value'";
			$data = $this->_db->fetchRow($sql, "", Zend_Db::FETCH_OBJ);

			return $data;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}
	}

	public function _filter($objSearch=null,$order=null,$offset=null,$count=null)
	{
		try
		{
			$sql = "SELECT
						*
					FROM
						`$this->_table`
					WHERE
						1";

			$arrKey = array_keys((array)$objSearch);	

			if($arrKey)	
			{
				foreach($arrKey as $key)
				{
					if(!empty ($objSearch->$key))
						$sql .= " AND `$key` = '{$objSearch->$key}'";
				}
			}

			if($order)
				$sql .= " ORDER BY $order";
			if($count)
				$sql .= " LIMIT $offset,$count";
			
			$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);

			return $data;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}
	}

	public function _count($objSearch)
	{
		try
		{
			$sql = "SELECT
						COUNT($this->_key)
					FROM
						`$this->_table`
					WHERE
						1";
			$arrKey = array_keys((array)$objSearch);
			foreach($arrKey as $key)
			{
				if($objSearch->$key)
					$sql .= " AND `$key` = '{$objSearch->$key}'";
			}

			$count = $this->_db->fetchOne($sql);

			return $count;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
    	}
	}
}