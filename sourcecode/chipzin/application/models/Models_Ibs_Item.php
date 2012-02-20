<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

/**
* Ibs_Item model class
* @author KietMA
*/
class Models_Ibs_Item extends Models_Base
{
    const COL_ID = 'id';
    const COL_NAME = 'name';
    const COL_TYPE = 'type';
    const COL_DESCRIPTION = 'description';
    const COL_QUANTITY = 'quantity';
    const COL_HAVE_DEFAULT = 'have_default';
    const COL_KEY = 'key';
    const COL_EFFECT = 'effect';
    const COL_LIMITED = 'limited';
    const COL_USE_AT_HOME = 'use_at_home';
    const COL_MAX_LEVEL = 'max_leve';
    const COL_EXP = 'exp';
    const COL_REFINE_LEVEL = 'refine_level';
    const COL_EXPIRED_COIN = 'expired_coin';
    const COL_IMAGE = 'image';
    const COL_ITEM_ID_TEXT = 'item_id_text';
    
    public function __construct()
    {
        parent::__construct();
        $this->_key = "id";
        $this->_table = "ibs_item";
    }
    
    /**
    * Get item by id
    * 
    * @param mixed $id
    * @return array
    * @author KietMA
    */
    public function getById($id)
    {
        $sql = "SELECT * FROM ibs_item WHERE id = $id";
        
        $data = $this->_db->fetchAll($sql);
        
        if (count($data) > 0)
            return $data[0];
        
        return $data;
    }
    
    /**
    * Search like by fieldname and value
    * 
    * @param mixed $fieldName
    * @param mixed $value
    * @return array
    * @author KietMA
    */
    public function searchLike($fieldName, $value)
    {
        $sql = "SELECT * FROM ibs_item WHERE `$fieldName` LIKE '%$value%'";
        
        $data = $this->_db->fetchAll($sql);
        return $data;
    }
}  
?>
