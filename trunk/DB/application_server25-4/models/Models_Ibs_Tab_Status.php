<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

/**
* Ibs_Tab_Status model class
* @author KietMA
*/
class Models_Ibs_Tab_Status extends Models_Base
{
    public function __construct()
    {
        parent::__construct();        
        $this->_key = 'id';
        $this->_table = 'ibs_tab_status';
    }
    
    /**
    * Get all from table
    * @author KietMA
    */
    public function getAll()
    {
        $sql = 'SELECT * FROM ibs_tab_status';
        
        $data = $this->_db->fetchAll($sql);
        
        return $data;
    }
}  
?>
