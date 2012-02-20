<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

/**
* @author KietMA
*/
class Models_Reason_Detail extends Models_Base
{
    public function __construct()
    {
        parent::__construct();        
        $this->_key = "id";
        $this->_table = "reason_detail";
    }

    /**
    * Get list of reason for data grid
    * 
    * @param mixed $paramArr
    * @return array
    */
    public function getReasonDetail($paramArr)
    {
        $start = isset($paramArr['start'])?$paramArr['start']:NULL;
        $limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
        $sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'rd.id';
        $sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'asc';
        $whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
        
        if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
        else $optLimit = NULL;
        
        if(!empty($whereParam)) $whereClause = " WHERE true ".$whereParam;
        else $whereClause = " where true ";
        
        $SQL = 'SELECT rd.id, rd.reason_id, rd.name, rd.enable ';
        $SQL .= 'FROM reason_detail rd INNER JOIN reason r ON rd.reason_id = r.id';
        $SQL .= "$whereClause order by $sortField $sortOrder $optLimit ";
        
        $result = $this->_db->fetchAll($SQL);
        
        return $result;
    }
    
    /**
    * Insert new record
    * @author KietMA
    */
    public function insert($data){
        $obj['reason_id'] = $data['reason_id'];
        $obj['name'] = $data['name'];
        $obj['enable'] = $data['enable'];
        
        $this->_db->insert('reason_detail', $obj);
        return $this->_db->lastInsertId('reason_detail','id');
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
        $obj->reason_id = $data['reason_id'];
        $obj->name = $data['name'];
        $obj->enable = $data['enable'];
        
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
    * Get all records in table
    * @author KietMA
    */
    public function getReasonDetailByReasonId($reasonId)
    {
        $sql = 'SELECT * FROM reason_detail WHERE reason_id = '.$reasonId;
        
        $data = $this->_db->fetchAll($sql);
        
        return $data;
    }
    
    /**
    * Get all records in table
    * @author KietMA
    */
    public function getAll()
    {
        $sql = 'SELECT * FROM reason_detail';
        
        $data = $this->_db->fetchAll($sql);
        
        return $data;
    }
    
    /**
    * Get all active records in table
    * @author KietMA
    */
    public function getAllActive()
    {
        $sql = 'SELECT * FROM reason_detail WHERE `enable` = 1';
        
        $data = $this->_db->fetchAll($sql);
        
        return $data;
    }
}
?>
