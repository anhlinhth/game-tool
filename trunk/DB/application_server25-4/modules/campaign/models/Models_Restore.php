<?php
//require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_Award.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Restore extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_backup";	
	}
	public function getdata()
	{
		$sql ="SELECT
					*
				FROM
					c_backup
				WHERE
					1
				ORDER BY ID DESC";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
	public function getLink($id)
	{
		$sql ="SELECT
					Link
				FROM
					c_backup
				WHERE
				ID=$id";
		$data = $this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);
		$url = ROOT."\application\modules\campaign\backup_data"."\\".$data;
		return $url;
	}
	public function delete($ID)
	{
		try
		{
			$sql="
		    	SELECT Link
		    		FROM c_backup
		    	WHERE
		   			 ID='".$ID."'";		    	
		    $data = $this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);
			$url = ROOT."\application\modules\campaign\backup_data"."\\".$data;
			unlink($url);
		    $sql="
		    	DELETE
		    		FROM c_backup
		 	  	WHERE
		   			 ID='".$ID."'";		    	
			    $data=$this->_db->query($sql);
		   	
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	public function count()
	{
		$sql ="SELECT
					COUNT(LINK)
				FROM
					c_backup
				WHERE
					1";
		$data = $this->_db->fetchOne($sql, "", Zend_Db::FETCH_OBJ);
		return $data;
	}
}
