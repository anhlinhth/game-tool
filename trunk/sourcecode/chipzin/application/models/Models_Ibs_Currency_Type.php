<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

/**
* Ibs_Currency_Type model class
* @author KietMA
*/
class Models_Ibs_Currency_Type extends Models_Base
{
    public function __construct()
    {
        parent::__construct();        
        $this->_key = "id";
        $this->_table = "ibs_currency_type";
    }
    
    /**
    * Get all from table
    * @author KietMA
    */
    public function getAll()
    {
        $sql = 'SELECT * FROM ibs_currency_type';
        
        $data = $this->_db->fetchAll($sql);
        
        return $data;
    }
}  
?>
