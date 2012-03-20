<?php
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Base.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Item.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_SaleOff_Shop.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Quest_Line.php';

class Models_Quest_xfj extends Models_Base {
	public function __construct() {
		parent::__construct ();
		$this->_key = "id";
		$this->_table = "q_quest";
	}
	public function getGiftType() {
		$sql = "SELECT
					*
				FROM
					q_quest";
		
		$data = $this->_db->fetchAll ( $sql );
		
		return $data;
	}
	public function lastId() {
		$sql = "SELECT COUNT(QuestID)
				FROM
					q_quest
					";
		
		$count = $this->_db->fetchOne ( $sql );
		
		return $count;
	}
	public function taskId() {
		$sql = "SELECT COUNT(TaskID)
				FROM
					q_task
					";
		
		$count = $this->_db->fetchOne ( $sql );
		
		return $count;
	}
	public function nextquest($search) {
		$sql = "SELECT *
		
				FROM
					q_nextquest
				WHERE
					QuestID = '$search'
					";
		
		$data = $this->_db->fetchAll ( $sql , "", Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	public function countquest($search) {
		$sql = "SELECT COUNT(NextQuest)
		
				FROM
					q_nextquest
				WHERE
					QuestID = '$search'
					";
		
		$data = $this->_db->fetchOne ( $sql , "", Zend_Db::FETCH_OBJ);
		
		return $data;
	}
	public function generate($data) {
		$str .= "{";
		$mdGiftPackageDetail = new Models_Quest_Package_Detail ();
		if ($data) {
			$i = 1;
			$mdGiftPackageDetail = new Models_Quest_Package_Detail ();
			$mdQL = new Models_Quest_Line();
			$qtc = new Models_QTC ();
			$str .= "\n";
			$str .= " \t\"quests\"  :";
			$str .= "\n\t{";
			foreach ( $data as $row ) {
				
				$str .= "\n\t\t\"" . ( int ) $row ['QuestID'] . "\":";
				$temp = ( int ) $row ['QuestID'];
				$str .= "\n\t\t{";
				
				$LineIcon= $mdQL->search($row ['QuestLineID']);
				$str .= "\n\t\t\t \"group\" : " . ( int ) $LineIcon ['QuestLineIcon'] . ",";
				
				//$str .= "\n\t\t\t \"group\" : " . ( int ) $row ['QuestLineID'] . ",";
				$data1 = $this->nextquest($row['QuestID']);
				$data2 = $this->countquest($row['QuestID']);
				if ($data1)
				{
					$u=1;
					$str .= "\n\t\t\t \"nextQuest\" : [";
					foreach($data1 as $row2)
					if($row2->NextQuest!=NULL)
					{
						if($data2==1)
							$str .="\"".( int ) $row2->NextQuest."\"";
						else
							if($u!=$data2)
							{
								$str .="\"".( int ) $row2->NextQuest."\",";
								$u++;
							}
							else 
								$str .="\"".( int ) $row2->NextQuest."\"";
					}
					$str .= "],";
				}
				else
					$str .= "\n\t\t\t \"nextQuest\" : [],";
				
				$str .= "\n\t\t\t \"tasks\" : [";
				$objSearch->task_package_id = $row->id;
				$gifts = $mdGiftPackageDetail->_filter ( $objSearch );
				if ($gifts) {
					$j = 0;
					foreach ( $gifts as $gift ) {
						if ($temp == $gift->QuestID) {
							$j ++;
							if ($j == 2) {
								$str .= ",";
								$j = 1;
							}
							$str .= "\"" . ( int ) $gift->TaskID . "\"";
						
						}
					
					}
				}
				$str .= "]";
				$str .= ",\n\t\t\t \"txtName\" : \"" . trim ( $row ['QuestString'] ) . "\",";
				$str .= "\n\t\t\t \"txtAlias\" : \"" . trim ( $row ['QuestGroupString'] ) . "\",";
				$str .= "\n\t\t\t \"txtDesc\" : \"" . trim ( $row ['QuestDescString'] ) . "\",";
				$str .= "\n\t\t\t \"award\" :";
				$str .= "\n\t\t\t { ";
				if ($row ['AwardGold'] != 0)
					$str .= "\n\t\t\t\t \"gold\" : " . $row ['AwardGold'] . ",";
				if ($row ['AwardExp'] != 0)
					$str .= "\n\t\t\t\t \"exp\" : " . $row ['AwardExp'];
				$str .= "\n\t\t\t } ";
				
				$c = $this->lastId ();
				if (( int ) $c != ( int ) $i)
					$str .= "\n\t\t}, \n";
				else
					$str .= "\n\t\t } \n";
				$i ++;
			}
		}
		$md = new Models_Task_Target_Package_Detail ();
		$am = new Models_QTC ();
		$i = 0;
		if ($gifts) {
			
			$str .= "},\n";
			$str .= "\n";
			$str .= " \t\"quest_tasks\"  :";
			$str .= "\n\t{";
			foreach ( $gifts as $gifts ) {
				$str .= "\n\t\t\"" . ( int ) $gifts->TaskID . "\" :";
				$i ++;
				$str .= "\n\t\t{";
				$str .= "\n\t\t\t \"questId\" : " . ( int ) $gifts->QuestID . ",";
				$str .= "\n\t\t\t \"payFinish\" : " . ( int ) $gifts->UnlockCoin . ",";
				$str .= "\n\t\t\t \"quantity\" : " . ( int ) $gifts->Quantity . ",";
				$objSearch->task_package_id = $gifts->id;
				$sf = $am->_filter ( $objSearch );
				
				if ($sf) {
					foreach ( $sf as $sf ) {
						if (( int ) $gifts->QTC_ID == ( int ) $sf->QTC_ID)
							$str .= "\n\t\t\t \"taskType\" : \"" . $sf->QTC_Name . "\",";
					}
				} else
					$str .= "\n\t\t\t \"taskType\" : [],";
				$objSearch->task_package_id = $gifts->id;
				$sf = $md->_filter ( $objSearch );
				
				if (file_exists ( ROOT_IMPORT_FILE . '/system.xfj' ) == false)
					echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('check file exits')</SCRIPT>");
				
				$file2 = ROOT_IMPORT_FILE . '/system.xfj';
				//if(file2==NULL)
				

				//	else echo("<SCRIPT LANGUAGE='JavaScript'>window.alert('Ok')</SCRIPT>");
				$fileContent = file_get_contents ( $file2 );
				$arr = json_decode ( $fileContent );
				
				if ($gifts->TargetType != NULL) {
					
					foreach ( $arr->entity as $key => $value ) {
						if ($key == $gifts->TargetType) {
							
							$str .= "\n\t\t\t \"gameType\" : [\"" . $value->gameType . "\"],";
						}
					}
				} else {
					$a = 0;
					if ($sf) {
						foreach ( $sf as $sf ) {
							//var_dump($gift);
							//exit();
							if (( int ) $sf->TaskID == ( int ) $gifts->TaskID && $a == 0) {
								$str .= "\n\t\t\t \"entityType\" : [" . "\"" . ( int ) $sf->TargetID . "\"";
								$a = 1;
								continue;
							}
							if (( int ) $sf->TaskID == ( int ) $gifts->TaskID && $a == 1) {
								$str .= ",\"" . ( int ) $sf->TargetID . "\"";
							}
						}
						if ($a != 0)
							$str .= "],";
					}
					if ($a == 0)
						$str .= "\n\t\t\t \"gameType\" : " . "[]" . ",";
				}
				$str .= "\n\t\t\t \"txtContent\" : \"" . trim ( $gifts->TaskString ) . "\",";
				$str .= "\n\t\t\t \"txtHelp\" : \"" . trim ( $gifts->DescID ) . "\",";
				$str .= "\n\t\t\t \"iconClassName\" : \"" . trim ( $gifts->IconClassName ) . "\",";
				$str .= "\n\t\t\t \"iconBucketName\" : \"" . trim ( $gifts->IconPackageName ) . "\"";
				$c = $this->taskId ();
				if (( int ) $c != ( int ) $i)
					$str .= "\n\t\t },\n";
				else
					$str .= "\n\t\t } \n";
			
			}
			$str .= "\n\t }";
		}
		$str .= "\n}";
		
		$fp = fopen ( QUEST_PACKAGE_XFJ_FILE, 'w' );
		if (fwrite ( $fp, $str ) === false) {
			return false;
		}
		fclose ( $fp );
		return true;
	}
}
?>