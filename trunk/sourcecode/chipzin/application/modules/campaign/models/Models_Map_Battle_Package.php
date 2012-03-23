<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'Object'.DS.'Obj_Campaign.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Map_Battle_Package extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_campaign";		
	}
	
	public function insert($obj)
	{
		parent::_insert($obj);		
	}
	
	public function update($obj)
	{
		try{
		parent::_update($obj);}
		catch (Exception $e){echo $e;}
	}
	
	public function delete($id)
	{
		parent::_delete($id,null);
	}
	public function getBattle($id)
	{
			$sql = "SELECT
					*
				FROM
					c_battle
				WHERE
					Campaign='$id'";
			$data = $this->_db->fetchAll($sql);
		
			return $data;
	}
	public function countBattle($id)
	{
			$sql = "SELECT
					COUNT(ID)
				FROM
					c_battle
				WHERE
					Campaign='$id'";
			$data = $this->_db->fetchOne($sql);
		
			return $data;
	}
	public function count()
	{
			$sql = "SELECT
					COUNT(ID)
				FROM
					c_campaign
				WHERE
					1";
			$data = $this->_db->fetchOne($sql);
		
			return $data;
	}
	public function generate($data)
	{
		$j = 1;
		$countc = $this->count();
		$error = array();
		$str .= "<?php\nreturn array\n(\n";
		foreach ($data as $row)
		{
			if($row['TypeID']==1)
			{
				$str .= "\tMAP_".$row['ID']." => array \n ";
				$str .= "\t(\n";
				$str .= "\t\t'openBattles' => array(";
				$bat=$this->getBattle($row['ID']);
				//if($bat==NULL)
				//	return 1;
				$count = $this->countBattle($row['ID']);
				$i=1;
				foreach ($bat as $row2)
				{
					if($i<$count)
						$str .=$row2['ID'].",";
					else 
						$str .=$row2['ID'];
					$i++;
				}
				$str ."),\n";
				$str .=")\n";
				if($j<$countc)
					$str .="\t),\n";
				else 
					$str .="\t)\n";
				
				
			}
			else 
			{
			
	
			
				$str .= "\tBARRACK_$i => array \n ";
				$str .= "\t(\n";
				$str .= "\t\t'openBattles' => array(";
				$bat=$this->getBattle($row['ID']);
				$count = $this->countBattle($row['ID']);
				$i=1;
				//if($bat==NULL)
				//	return 1;
				foreach ($bat as $row2)
				{
					if($i<$count)
						$str .=$row2['ID'].",";
					else 
						$str .=$row2['ID'];
					$i++;
				}
				$str ."),\n";
				$str .=")\n";
				if($j<$countc)
					$str .="\t),\n";
				else 
					$str .="\t)\n";
				
			}
			$j++;
			}
			$str .= ");\n?>";
		if(empty($error)){
			$fp = fopen(MAP_BATTLE_PACKAGE_PHP_FILE, 'w');
			if(fwrite($fp, $str) === false)
			{
				fclose($fp);				
			}
		}else{
			return $error;
		}		
		
	}
}
?>