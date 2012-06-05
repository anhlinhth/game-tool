<?php 
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_S_ibshop_item extends Models_Base
{
public function __construct()
    {
        parent::__construct();
        $this->_key = "ID";
        $this->_table = "s_ibshop_item";
    }
public function insert($obj)
	{
		try{
		$id= $this->_insert($obj);
		return $id;
		}
		catch (Exception $e)
		{
			var_dump($obj);
			
		}
	}
public function deleteall()
{
	$sql="
		DELETE FROM `s_ibshop_item` WHERE 1;
ALTER TABLE s_ibshop_item AUTO_INCREMENT=1;
		";
		$kq=$this->_db->query($sql);
		return kq;
}

public function Items($idshop)
{
	$sql="
		SELECT *
		FROM s_ibshop_item
		WHERE IbShopID=$idshop
		";
		
		return $this->_db->fetchAll($sql);
}
}
?>