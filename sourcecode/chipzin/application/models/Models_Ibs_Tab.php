<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

/**
* Ibs_Tab model class
* @author KietMA
*/
class Models_Ibs_Tab extends Models_Base
{
    public function __construct()
    {
        parent::__construct();        
        $this->_key = "id";
        $this->_table = "ibs_tab";
    }
    
    public function getTabByShop($shopid)
    {
        $sql = "SELECT * FROM ibs_tab WHERE shop_id = $shopid ORDER BY position ASC";
        
        $data = $this->_db->fetchAll($sql);
        
        return $data;
    }
    
    /**
    * Update postion of tab in shop
    * 
    * @param mixed $shopid
    * @param mixed $tabid
    * @param mixed $pos
    * @author KietMA
    */
    public function updatePosition($shopid, $tabid, $pos)
    {
        $sql = "UPDATE ibs_tab SET position = $pos WHERE shop_id = $shopid AND id = $tabid";
        
        $this->_db->query($sql);
    }
    
    /**
    * Get tab by shop for jqgrid
    * 
    * @param mixed $paramArr
    * @return array
    * @author
    */
    public function getTab($paramArr)
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
        
        $SQL = 'SELECT t.id, t.shop_id,t.type, t.name, t.position, t.status ';
        $SQL .= 'FROM ibs_tab t INNER JOIN ibs_shop s ON t.shop_id = s.id ';
        $SQL .= "$whereClause order by $sortField $sortOrder $optLimit ";
        
        $result = $this->_db->fetchAll($SQL);
        
        return $result;
    }
    
    /**
    * Delete all tab by shop
    * 
    * @param mixed $paramArr
    * @author KietMA
    */
    public function deleteTabByShop($id)
    {
        $SQL = 'DELETE ibs_tab FROM ibs_tab, ibs_shop, ';
        $SQL .= 'WHERE  shop_id = ' . $id . ' AND shop_id = ibs_shop.id AND count()';
        
        $result = $this->_db->query($SQL);
    }
    
    /**
    * Insert new record
    * @author KietMA
    */
    public function insert($data){
        $obj['shop_id'] = $data['shop_id'];
        $obj['type'] = $data['type'];
        $obj['name'] = $data['name'];
        $obj['position'] = $data['position'];
        $obj['status'] = $data['status'];
        
        $this->_db->insert('ibs_tab', $obj);
        return $this->_db->lastInsertId('ibs_tab','id');
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
        $obj->shop_id = $data['shop_id'];
        $obj->type = $data['type'];
        $obj->name = $data['name'];
        $obj->position = $data['position'];
        $obj->status = $data['status'];

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
    
    /**
    * Count number of tab in shop
    * 
    * @param mixed $shopId
    * @return string
    */
    public function countRowByShop($shopId)
    {
        $obj->shop_id = $shopId;
        $result = parent::_count($obj);
        
        return $result;
    }
}  
?>
