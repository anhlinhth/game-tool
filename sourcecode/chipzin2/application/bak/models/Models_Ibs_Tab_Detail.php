<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

/**
* Ibs_Tab_Detail model class
* @author KietMA
*/
class Models_Ibs_Tab_Detail extends Models_Base
{
    public function __construct()
    {
        parent::__construct();        
        $this->_key = "id";
        $this->_table = "ibs_tab_detail";
    }
    
    public function getByTab($tabid)
    {
        $sql = "SELECT * FROM ibs_tab_detail WHERE tab_id = $tabid ORDER BY position ASC";
        
        $data = $this->_db->fetchAll($sql);
        
        return $data;
    }
    
    public function updatePosition($id, $pos)
    {
        $sql = "UPDATE ibs_tab_detail SET position = $pos WHERE id = $id";
        
        $this->_db->query($sql);
    }
    
    /**
    * Update
    * 
    * @param mixed $data
    * @author KietMA
    */
    public function update($data)
    {
        $obj->id = $data['id'];
        $obj->tab_id = $data['tab_id'];
        $obj->tab_item_id = $data['tab_item_id'];
        $obj->tab_item_type = $data['tab_item_type'];
        $obj->price = $data['price'];
        $obj->price_display = $data['price_display'];
        $obj->discount = $data['discount'];
        $obj->currency_type = $data['currency_type'];
        $obj->position = $data['position'];
        $obj->status = $data['status'];
        $obj->enabled = $data['enabled'];
        
        parent::_update($obj);
    }
    
    public function insert($data)
    {
        $obj['tab_id'] = $data['tab_id'];
        $obj['tab_item_id'] = $data['tab_item_id'];
        $obj['tab_item_type'] = $data['tab_item_type'];
        $obj['price'] = $data['price'];
        $obj['price_display'] = $data['price_display'];
        $obj['discount'] = $data['discount'];
        $obj['currency_type'] = $data['currency_type'];
        $obj['position'] = $data['position'];
        $obj['status'] = $data['status'];
        $obj['enabled'] = $data['enabled'];
        
        $this->_db->insert('ibs_tab_detail', $obj);
        return $this->_db->lastInsertId('ibs_tab_detail','id');
    }
    
    /**
    * Count number of item in tab
    * 
    * @param mixed $tabId
    * @return string
    */
    public function countRowByTab($tabId)
    {
        $obj->tab_id = $tabId;
        
        return parent::_count($obj);
    }
}  
?>
