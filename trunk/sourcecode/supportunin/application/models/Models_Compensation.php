<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_Compensation extends Models_Base
{
    public function __construct()
    {
        parent::__construct();        
        $this->_key = 'id';
        $this->_table = 'compensation';
    }
    
    /**
    * Get compensation
    * 
    * @param mixed $paramArr
    * @return array
    * @author KietMA
    */
    public function getCompensation($paramArr)
    {
        $start = isset($paramArr['start'])?$paramArr['start']:NULL;
        $limit = isset($paramArr['limit'])?$paramArr['start']:NULL;
        $sortField = isset($paramArr['sortField'])?$paramArr['sortField']:'id';
        $sortOrder = isset($paramArr['sortOrder'])?$paramArr['sortOrder']:'asc';
        $whereParam = isset($paramArr['whereParam'])?$paramArr['whereParam']:NULL;
        
        if(!empty($start) && !empty($limit)) $optLimit = "limit $start,$limit";
        else $optLimit = NULL;
        
        if(!empty($whereParam)) $whereClause = " WHERE true ".$whereParam;
        else $whereClause = " where true ";
        $SQL = 'SELECT  id, char_id,char_name, create_date, status, comment, create_by, approve_by,approve_date, execute_date, execute_by, reason, reason_desc, reason_id, reason_detail_id ';
        $SQL .= 'FROM compensation ';
        $SQL .= "$whereClause order by $sortField $sortOrder $optLimit ";
        
        $result = $this->_db->fetchAll($SQL);
        
        return $result;
    }
    /**
    * @param mixed $paramArr
    * @return array
    * @author MaiTTT
    * 
    */
    public function insertCompensation($paramArr)
    {
        $charName = $paramArr['CharName'];
        $charId = $paramArr['CharID'];
        $comment = $paramArr['Comment'];
        $createBy = $paramArr['CreateBy'];
        $reason = $paramArr['Reason'];
        $reasonDesc = $paramArr['ReasonDesc'];
        $reasonId = $paramArr['reason_id'];
        $reasonDetailId = $paramArr['reason_detail_id'];
        $status = AppConstant::COMPENSATION_WAITING;
        $createDate = date(AppConstant::DATE_TIME_FORMAT);
        
        $paramArr['CreateDate'] = '\'' . date(AppConstant::DATE_TIME_FORMAT).'\'';
        $paramArr['Status'] = -1; // chua duyet
        
        $SQL = 'INSERT INTO compensation(char_name,char_id,comment,create_by,create_date,status,reason, reason_desc, reason_id, reason_detail_id) ';
        $SQL .= "VALUES ('$charName','$charId','$comment','$createBy','$createDate','$status','$reason','$reasonDesc', $reasonId, $reasonDetailId)";
        
        $result = $this->_db->query($SQL);
        //$this->_db->insert('commpensation')
    }
    /**
    * @param mixed $paramArr
    * @return array
    * @author MaiTTT
    * 
    */
    public function updateCompensation($paramArr)
    {
        $charName = $paramArr['CharName'];
        $comment = $paramArr['Comment'];
        $reason = $paramArr['Reason'];
        $reasonDesc = $paramArr['ReasonDesc'];
        $reasonId = $paramArr['reason_id'];
        $reasonDetailId = $paramArr['reason_detail_id'];
        $id = $paramArr['id'];
        
        $SQL = 'UPDATE compensation ';
        $SQL .= "SET char_name = '$charName',comment='$comment', reason = '$reason', reason_desc = '$reasonDesc', reason_id = $reasonId, reason_detail_id = $reasonDetailId WHERE id= $id";
        $result = $this->_db->query($SQL);
    }
    /**
    * @param mixed $paramArr
    * @return array
    * @author MaiTTT
    * 
    */
    public function deleteCompensation($paramArr)
    {
        $SQL = 'DELETE FROM compensation WHERE status != 2 AND id = ' . $paramArr['id'];
        $result = $this->_db->query($SQL);
    }
    
    public function checkCompesation($id)
    {
        $SQL = 'SELECT  * ';
        $SQL .= 'FROM compensation ';
        $SQL .= 'WHERE id = ' .$id . ' AND status = -1';
        $result = $this->_db->fetchAll($SQL);
        if(count($result) > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function approveCompesation($arrId,$type, $by, $date)
    {
        $SQL = "UPDATE compensation SET status =  $type ";
        
        if ($type == AppConstant::COMPENSATION_APRROVED)
        {
            $SQL .= ", approve_by = '$by', approve_date = '$date' ";
        }
        
        $SQL .= "WHERE status != 2 AND id IN ($arrId)";
       
        $result = $this->_db->query($SQL);
        
        return $result;
    }
    
    
    /**
    * Update
    * 
    * @param mixed $obj
    * @author KietMA
    */
    public function update($obj)
    {
        parent::_update($obj);
    }    
    
    public function getStatistic($data)
    {
    	$queryParams = $this->getQueryParams($data);
    	$result = $this->queryData($queryParams);
    	$categories = Utility::getCategories($result);
    	if($data["key"] == "0")
		{
			$datasets = $this->getDatasets_1($result);
		}
		else if($data["key"] == "1")
		{
			$datasets = $this->getDatasets_2($result);
		}
		//var_dump($result);  	
		return array("categories" => $categories, "datasets" => $datasets);
    }
    
    /**
    * Thong ke theo ly do
    * 
    * @param mixed $data
    */
	private function getDatasets_1($data)
	{
		$datasets = array();

		for($i = 0; $i < count($data); $i++)
		{
			$denbu = array();
			$vanhanh = array();
			$khac = array();
			for($j = 0; $j < count($data[$i]); $j++)
			{
				array_push($denbu, $data[$i][$j]["DenBu"]);
				array_push($vanhanh, $data[$i][$j]["VanHanh"]);
				array_push($khac, $data[$i][$j]["Khac"]);
			}

			array_push($datasets, $denbu);
			array_push($datasets, $vanhanh);
			array_push($datasets, $khac);
		}

		return $datasets;
	}
    
    /**
    * Thong ke theo tung loai vat pham
    * 
    * @param mixed $data
    */
	private function getDatasets_2($data)
	{
		$datasets = array();

		for($i = 0; $i < count($data); $i++)
		{
			$gold = array();
			$xu = array();
			$item = array();
            $groupitem = array();
			$pig = array();
            $exp = array();
            $kiss = array();
            
			for($j = 0; $j < count($data[$i]); $j++)
			{
				array_push($pig, $data[$i][$j]["pig"]);
                array_push($item, $data[$i][$j]["item"]);
                array_push($groupitem, $data[$i][$j]["groupitem"]);
                array_push($xu, $data[$i][$j]["xu"]);
                array_push($gold, $data[$i][$j]["gold"]);
				array_push($exp, $data[$i][$j]["exp"]);
                array_push($kiss, $data[$i][$j]["kiss"]);
			}

			array_push($datasets, $pig);
            array_push($datasets, $item);
            array_push($datasets, $groupitem);
			array_push($datasets, $xu);
            array_push($datasets, $gold);
            array_push($datasets, $exp);
            array_push($datasets, $kiss);
		}

		return $datasets;
	}
    
    /**
    * put your comment there...
    * 
    * @param mixed $data
    */
	private function getQueryParams($data)
	{
		$queryParams = array();

		$queryParam = array();

		$queryParam["key"] = $data["key"];
		$queryParam["datefrom"] = $data["datefrom"];
		$queryParam["dateto"] = $data["dateto"];
        $queryParam["reason"] = $data["reason"];
		
		array_push($queryParams, $queryParam);

		return $queryParams;
	}
    
    /**
    * put your comment there...
    * 
    * @param mixed $queryParams
    */
	public function queryData($queryParams)
	{
		$data = array();

		for($i = 0; $i < count($queryParams); $i++)
		{
			$query = $this->getQuery($queryParams[$i]);
			$result = $this->_db->fetchAll($query);
			array_push($data, $result);
		}

		return $data;
	}
    
    /**
    * put your comment there...
    * 
    * @param mixed $queryParam
    */
	private function getQuery($queryParam)
	{
        $query = '';
		if ($queryParam['key'] == 0) // Thong ke theo ly do
        {
		    $query = "SELECT date(`execute_date`) AS `Key` , count(
							    CASE WHEN `reason` LIKE 'denbu'
								    THEN 1
								    ELSE NULL
							    END ) AS `DenBu` , count(
					    CASE WHEN `reason` LIKE 'vanhanh'
					    THEN 1
					    ELSE NULL
					    END ) AS `VanHanh` , count(
					    CASE WHEN `reason` LIKE 'other'
					    THEN 1
					    ELSE NULL
					    END ) AS `Khac`
					    FROM `compensation`
					    WHERE `execute_date` >=" . "'" . $queryParam['datefrom'] . "'" .
					    "AND `execute_date` <= " . "'" . $queryParam['dateto'] . "'" .
					    "GROUP BY `Key`
					    LIMIT 0 , 30";
        }
        else if($queryParam['key'] == 1) // Thong ke theo nhom vat pham
        {
            $query = "SELECT date(c.`execute_date`) AS `Key` , 
                            sum(CASE WHEN cd.`type` LIKE 'pig'
                                THEN `quantity`
                                ELSE 0
                            END ) AS `pig` , 
                            sum(CASE WHEN cd.`type` LIKE 'item'
                                THEN `quantity`
                                ELSE 0
                            END ) AS `item` , 
                            sum(CASE WHEN cd.`type` LIKE 'groupitem'
                                THEN `quantity`
                                ELSE 0
                            END ) AS `groupitem` , 
                            sum(CASE WHEN cd.`type` LIKE 'xu'
                                THEN `quantity`
                                ELSE 0
                            END ) AS `xu` , 
                            sum(CASE WHEN cd.`type` LIKE 'gold'
                                THEN `quantity`
                                ELSE 0
                            END ) AS `gold` , 
                            sum(CASE WHEN cd.`type` LIKE 'exp'
                                THEN `quantity`
                                ELSE 0
                            END ) AS `exp` , 
                            sum(CASE WHEN cd.`type` LIKE 'kiss'
                                THEN `quantity`
                                ELSE 0
                            END ) AS `kiss`
                    FROM `compensation` as c, `compensation_detail` as cd
                    WHERE c.`id` = cd.`compensation_id` and c.`status` = 2 
                    AND c.`execute_date` >=" . "'" . $queryParam['datefrom'] . "'" .
                    "AND c.`execute_date` <= " . "'" . $queryParam['dateto'] . "'" .
                    "AND c.`reason` = " . "'" . $queryParam['reason'] . "'" .
                    "GROUP BY `Key`
                    LIMIT 0 , 30";
        }
        
		return $query;
	}		 
}
?>
