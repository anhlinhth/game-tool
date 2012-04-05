<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_C_Award extends Models_Base
{

 public function __construct()
    {
        parent::__construct();
        $this->_key = "ID";
        $this->_table = "c_award";
    }

public function insert($obj)
{
try
		{
			
    		$result=$this->_db->insert('c_award', $obj);
    		
    		return $result;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	
}

}