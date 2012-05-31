<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';

class Models_C_DeleteData extends Models_Base
{
	
public function deltele()
{
	$sql="
DELETE FROM `c_award` WHERE 1;
 ALTER TABLE c_award AUTO_INCREMENT=1; 
DELETE FROM `c_battle_soldier` WHERE 1;
 ALTER TABLE c_battle_soldier AUTO_INCREMENT=1; 
DELETE FROM `c_battle` WHERE 1;
 ALTER TABLE c_battle AUTO_INCREMENT=1;
DELETE FROM `c_campaign` WHERE 1;
 ALTER TABLE c_campaign AUTO_INCREMENT=1; 
 ";
	$all=$this->_db->query($sql);

return $all;

}
}