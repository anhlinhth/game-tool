<?php
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'Object'.DS.'Obj_Campaign.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Battle_Package extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "ID";
		$this->_table = "c_battle";		
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
	public function fetchall()
	{
		$sql = "SELECT
					*
				FROM
					c_battle
				WHERE
					1";
		$data = $this->_db->fetchAll($sql);
		
		return $data;
	}
	public function getawards($id)
	{
		$sql = "SELECT
					*
				FROM
					c_award
				WHERE
					BattleID ='$id'";
		$data = $this->_db->fetchAll($sql);
		
		return $data;
	}
	public function getcountaward($id)
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					c_award
				WHERE
					BattleID ='$id'";
		$data = $this->_db->fetchOne($sql);
		
		return $data;
	}
	public function getawardtype($id)
	{
		$sql = "SELECT
					Name
				FROM
					c_award_type
				WHERE
					AwardTypeID ='$id'";
		$data = $this->_db->fetchOne($sql);
		
		return $data;
	}
	public function getsoldier($id)
	{
		$sql = "SELECT
					*
				FROM
					c_battle_soldier
				WHERE
					BattleID ='$id'";
		$data = $this->_db->fetchAll($sql);
		
		return $data;
	}
	public function getnamesoldier($id)
	{
		$sql = "SELECT
					NameSV
				FROM
					c_soldier
				WHERE
					ID ='$id'";
		$data = $this->_db->fetchOne($sql);
		
		return $data;
	}
	public function countBattle()
	{
		$sql = "SELECT
					COUNT(ID)
				FROM
					c_battle
				WHERE
					1";
		$data = $this->_db->fetchOne($sql);
		
		return $data;
	}
	public function generate($data)
	{
		
		$error = array();
		$str .= "<?php\nreturn array\n(\n";
		$str .= "\t'max_turn' => 100,\n";
		$str .= "\t'random_min' => 1,\n";
		$str .= "\t'random_max' => 2,\n";
		$str .= "\t'loseGold' => 10,\n";
		$j=1;
		$countB = $this->countBattle(); 
		foreach($data as $row)
		{
			$str .= "\t".$row['ID']." => array \n";
			$str .= "\t(\n";
			$sol = $this->getsoldier($row['ID']);
			if($sol)
			{
				$str .= "\t\t'soldiers' => array\n";
				$str .= "\t\t(\n";
				
				
				foreach ($sol as $row3)
				{
					$str .= "\t\t\t".$row3['Point']." => array (".$this->getnamesoldier($row3['Soldier']).",".$row3['Level']."),\n";
				}
				$str .= "\t\t),\n";
			}
			else 
				$str .= "\t\t'soldiers' => NULL,\n";
			$aw = $this->getawards($row['ID']);
			if($aw)
			{
				$count = $this->getcountaward($row['ID']);
				$str .= "\t\t'awards' => array (";
				$i =1;
				foreach ($aw as $row2)
				{
					if($i<$count)
					{
						if(trim(strtolower($this->getawardtype($row2['AwardTypeID'])))=="exp")
							$str .="HONOUR"." => ".$row2['Value'].",";
						else
							$str .=strtoupper($this->getawardtype($row2['AwardTypeID']))." => ".$row2['Value'].",";
					}
					else 
					{
						if(trim(strtolower($this->getawardtype($row2['AwardTypeID'])))=="exp")
							$str .="HONOUR"." => ".$row2['Value'];
						else
						$str .=strtoupper($this->getawardtype($row2['AwardTypeID']))." => ".$row2['Value'];
					}
					$i++;
				}
				$str .=")\n";
			}
			else 
				$str .= "\t\t'awards' => NULL\n";
			if($j<$countB)
				$str .= "\t),\n";
			else
				$str .= "\t)\n";
			$j++;
		}
		$str .= ");\n?>";
		if(empty($error)){
			$fp = fopen(BATTLE_PACKAGE_PHP_FILE, 'w');
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