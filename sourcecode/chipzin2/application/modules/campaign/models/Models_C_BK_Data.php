<?php

require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_C_BK_Data extends Models_Base
{

	function  insert($filename,$date)
	{
	try
		{
			//$date= date("Y-m-d H:m:s");
			
			$data = array(
				'DateTime'=>$date,
				'Link'=>$filename
			);
    		$this->_db->insert('c_backup', $data);
    		$id = $this->_db->lastInsertId();

    		return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	}
	
	
}