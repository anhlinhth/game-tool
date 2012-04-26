<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_C_NextCamp extends Models_Base
{

public function insert($camp,$nextCamp)
{
try
		{
			$data = array(
				'CampID'=>$camp,
				'NextCamp'=>$nextCamp
			);
    		$this->_db->insert('c_nextcamp', $data);
    		$id = $this->_db->lastInsertId();

    		return $id;
		}
		catch(Zend_Db_Exception $ex)
		{
			throw new Internal_Error_Exception($ex);
		}
	
}




}