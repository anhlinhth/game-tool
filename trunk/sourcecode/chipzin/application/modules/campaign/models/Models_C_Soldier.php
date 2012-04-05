<?php
class Models_C_Soldier 
{
public function getIDSoldier($name)
	{
		$sql="
			SELECT 
				ID
			FROM
				c_soldier
			Where
				NameSV='$name'
			Limit 1
		";
		$data = $this->_db->fetchAll($sql, "", Zend_Db::FETCH_OBJ);		
		
		return $data;
	}
}