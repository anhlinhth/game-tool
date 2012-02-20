<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

/**
* Ibs_Shop model class
* @author KietMA
*/
class Models_Ibs_Shop extends Models_Base
{
    public function __construct()
    {
        parent::__construct();        
        $this->_key = "id";
        $this->_table = "ibs_shop";        
    }
    
    /**
    * Get all records in table
    * @author KietMA
    */
    public function getAll()
    {
        $sql = 'SELECT * FROM ibs_shop';
        
        $data = $this->_db->fetchAll($sql);
        
        return $data;
    }
    
    public function getShop($param)
    {
        $start = isset($paramArr['start'])?$paramArr['start']:NULL;
        $limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
        $sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'id';
        $sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'asc';
        $whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
        
        if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
        else $optLimit = NULL;
        
        if(!empty($whereParam)) $whereClause = " WHERE true ".$whereParam;
        else $whereClause = " where true ";
        
        $SQL = 'SELECT id, shop_id_text, name FROM ibs_shop ';
        $SQL .= "$whereClause order by $sortField $sortOrder $optLimit ";
        
        $result = $this->_db->fetchAll($SQL);
        
        return $result;
    }
    
    /**
    * Insert new record
    * @author KietMA
    */
    public function insert($data){
        $obj['shop_id_text'] = $data['shop_id_text'];
        $obj['name'] = $data['name'];
        
        $this->_db->insert('ibs_shop', $obj);
        return $this->_db->lastInsertId('ibs_shop','id');
    }
    
    /**
    * Update record
    * 
    * @param mixed $data
    * @author KietMA
    */
    public function update($data)
    {
        $obj->id = $data['id'];
        $obj->shop_id_text = $data['shop_id_text'];
        $obj->name = $data['name'];
        
        parent::_update($obj);
    }
    
    /**
    * Delete record
    * 
    * @param mixed $id
    * @author KietMA
    */
    public function delete($id)
    {
        parent::_delete($id);
    }
}  
?>
