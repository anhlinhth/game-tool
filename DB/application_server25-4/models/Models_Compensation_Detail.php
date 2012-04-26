<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Compensation_Detail extends Models_Base
{
    public function __construct()
    {
        parent::__construct();        
        $this->_key = 'id';
        $this->_table = 'compensation_detail';
    }
    
    /**
    * Get compensation detail
    * 
    * @param mixed $paramArr
    * @return array
    * @author KietMA
    */
    public function getCompensationDetail($paramArr)
    {
        $start = isset($paramArr['start'])?$paramArr['start']:NULL;
        $limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
        $sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'cd.id';
        $sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'asc';
        $whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
        
        if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
        else $optLimit = NULL;
        
        if(!empty($whereParam)) $whereClause = " WHERE true ".$whereParam;
        else $whereClause = " where true ";
        
        $SQL = 'SELECT  cd.id, cd.compensation_id, cd.type, cd.name, cd.rank,cd.image ,cd.quantity, cd.object_id ';
        $SQL .= 'FROM compensation_detail cd INNER JOIN compensation c ON cd.compensation_id = c.id';
        $SQL .= " $whereClause  ";
        //var_dump($SQL);
        $result = $this->_db->fetchAll($SQL);
        
        return $result;
    }
    
    public function insertCompensationDetail($paramArr)
    {
        $compensationId = $paramArr['compensation_id'];
        $type = $paramArr['type'];
        $qty =  $paramArr['quantity'];
        $objectId = $paramArr['object_id'];
        $rank = $paramArr['rank']?$paramArr['rank']:0;
        $name = $paramArr['name'];
        $img = $paramArr['image_save'];
        $SQL = 'INSERT INTO compensation_detail(compensation_id,type,quantity,object_id,name,image,rank) ';
        $SQL .= "VALUES ( $compensationId,'$type',$qty,'$objectId','$name','$img',$rank)";
        $result = $this->_db->query($SQL);
        echo $SQL;
    }
    public function updateCompensationDetail($paramArr)
    {
        $id = $paramArr['id'];
        $compensationId = $paramArr['compensation_id'];
        $type = $paramArr['type'];
        $quantity = $paramArr['quantity'];
        $objectId = $paramArr['object_id'];
        $name = $paramArr['name'];
        $img = $paramArr['image_save'];
        $rank = $paramArr['rank'];
        
        $SQL = "UPDATE compensation_detail SET compensation_id = $compensationId, type = '$type', quantity = $quantity, object_id = '$objectId', ";
        $SQL .= "name = '$name', image = '$img', rank = '$rank'";
        $SQL .= "WHERE id = $id";
        
        $result = $this->_db->query($SQL);
    }
    
    public function deleteCompensationDetail($paramArr)
    {
        $SQL = 'DELETE compensation_detail FROM compensation_detail, compensation ';
        $SQL .= 'WHERE  compensation_id = ' . $paramArr['id'] . ' AND compensation_id = compensation.id AND compensation.status != 2';
        $result = $this->_db->query($SQL);
    }
}  
?>
