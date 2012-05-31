<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

/**
* Ibs_Pig model class
* @author KietMA
*/
class Models_Ibs_Pig extends Models_Base
{
    const COL_ID = 'id';
    const COL_TYPE = 'type';
    const COL_DESCRIPTION = 'description';
    const COL_NAME = 'name';
    const COL_SHORT_DESC = 'short_desc';
    const COL_STEAL_PUNISH = 'steal_punish';
    const COL_BEGET_PRICE = 'beget_price';
    const COL_LEVEL = 'level';
    const COL_LIFE_CIRCLE = 'life_circle';
    const COL_STATUS_INDEX = 'status_index';
    const COL_WEIGHT_GAIN_PER_HOUR = 'weight_gain_per_hour';
    const COL_WEIGHT_DOWN_PER_HOUR = 'weight_down_per_hour';
    const COL_PRICE_FOR_ONE_KG = 'price_for_one_kg';
    const COL_WEIGHT = 'weight';
    const COL_UNIT = 'unit';
    const COL_IMAGE = 'image';
    const COL_AGE = 'age';
    const COL_SPECIAL_PIG = 'special_pig';
    const COL_SELL_EXP = 'sell_exp';
    const COL_GROUP = 'group';
    const COL_HOLY_LEVEL = 'holy_level';
    const COL_STAR = 'star';
    const COL_LVGF = 'lvgf';
    const COL_GOLD_MIN = 'gold_min';
    const COL_GOLD_MAX = 'gold_max';
    
    public function __construct()
    {
        parent::__construct();
        $this->_key = "id";
        $this->_table = "ibs_pig";
    }
    
    /**
    * Get pig by id
    * 
    * @param mixed $id
    * @return array
    * @author KietMA
    */
    public function getById($id)
    {
        $sql = "SELECT * FROM ibs_pig WHERE id = $id";
        
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
        $sql = "SELECT * FROM ibs_pig WHERE `$fieldName` LIKE '%$value%'";
        
        $data = $this->_db->fetchAll($sql);
        return $data;
    }
}  
?>
