<?php
	class LineHandler
	{
		public $ctype;
		private $rtype;
		private $rvalue;
		
		public $actionType;
		public $moneyType;
		public $numGroup;
		public $numLvlFrom;
		public $numLvlTo;
		
		private $dbHelper;
		
		function LineHandler()
		{
			include_once('Constants.php');	
			include_once('ChartItem.php');
			include_once('../util/DBHelper.php');
			
			$this->dbHelper = new DBHelper("SynDB");	
		}
		
		function genXml($rtype, $rvalue, $fromdate, $todate)
		{
			$this->rvalue = $rvalue;
			if ($this->actionType)
			{
				//for source-sink
				$dataset = $this->getDataSS($rtype,$fromdate, $todate, $this->actionType, 
					$this->moneyType, $this->numGroup, $this->numLvlFrom, $this->numLvlTo);
				
				$xml = "<chart caption=\"Sources Sinks\" subcaption=\"";
				$xml .= "\">\n";
				$xml .= $this->getCategories($dataset);
				$xml .= $this->serializeDataSet($dataset);
				$xml .= "</chart>";
				
				return $xml;
			}
			else 
			{
				//for common reports
				$allTypes = split("x", $rtype);
				$datasets = array();
				$category = "";
				
				for ($i = 0; $i < count($allTypes); $i++)
				{
					$atype = $allTypes[$i];
					$dataset = $this->getData($atype, $rvalue, $fromdate, $todate);
					array_push($datasets, $dataset);
					
					if (!$category)
					{
						$category = $this->getCategories($dataset);	
					}
				}
				
				$xml = "<chart caption=\"Common Report\" subcaption=\"";
				$xml .= $rtype;
				$xml .= $rvalue;
				$xml .= "\">\n";
				$xml .= $category;
				
				for ($j = 0; $j < count($datasets); $j++)
				{
					$xml .= $this->serializeDataSet($datasets[$j], $allTypes[$j]);	
				}
				
				$xml .= "</chart>";
				
				return $xml;
			}
		}
		
		function serializeDataSet($dataset, $atype)
		{
			$result = "<dataset seriesName=\"";
			$result .= $atype;
			$result .= $this->rvalue;
			$result .= "\">\n"; 
			
			for ($i = 0; $i < count($dataset); $i++)
			{
				$chartItem = new ChartItem(0);
				$chartItem = $dataset[$i];

				$chartLabel = $chartItem->chartLabel;
				$pid = $chartItem->pid;
				
				if (!$pid)
				{
					$pid = "0";	
				}
				
				$jsName = "on_item_click";
				
				if ($this->ctype == Constants::$LINE_TYPE)
				{
					$jsName = "on_line_click";
				}
				elseif ($this->ctype == Constants::$BAR_TYPE)
				{
					$jsName = "on_bar_click";
				}
				
				$result .= "<set link=\"javascript:$jsName($i,'$chartLabel', '$pid');\" value=\"";
				$result .= $chartItem->chartValue;
				$result .= "\"/>\n";
			}
			
			$result .= "</dataset>\n";
			return $result;
		}
		
		function getData($rtype,$rvalue,$fromdate,$todate)
		{
			$dataset = array();
			$query = "";
			$now = $this->getCurrentDate();
			
			$r_info = Constants::$commonreports[$rtype];
			
			$query = "CALL ";
			$query .= $r_info["sp"];
			$query .= "(1,'";
			$query .= $fromdate;
			$query .= "','";
			$query .= $todate;
			$query .= "',";
			$query .= $rvalue;
			$query .= ");";
			
			$result = $this->dbHelper->makeQuery($query);
			return $this->convertSqlResultToDataset($result);
		}
		
		function getDataSS($rtype,$fromdate, $todate,$actionType,$moneyType,$numGroup,$numLvlFrom,$numLvlTo)
		{
			$dataset = array();
			$query = "";
			
			$r_info = Constants::$commonreports[$rtype];
			
			$query = "CALL ";
			$query .= $r_info["sp"];
			$query .= "(1,'";
			$query .= $fromdate;
			$query .= "','";
			$query .= $todate;
			$query .= "',";
			$query .= $actionType;
			$query .= ",";
			$query .= $moneyType;
			$query .= ",";
			$query .= $numGroup;
			$query .= ",";
			$query .= $numLvlFrom;
			$query .= ",";
			$query .= $numLvlTo;
			$query .= ");";
			
			$result = $this->dbHelper->makeQuery($query);
			return $this->convertSqlResultToDataset($result);
		}
		
		function getCurrentDate()
		{
			$now = date("Y-m-d");
			return $now;
		}
		
		function getDateSub($days)
		{
			$expression = "-";
			$expression .= $days;
			
			if ($days <= 1)
			{
				$expression .= " day";
			}
			else
			{
				$expression .= " days";
			}
			
			$date = date("Y-m-d", strtotime($expression));
			return $date;
		}
		
		function convertSqlResultToDataset($result)
		{
			$dataset = array();
			$num = mysql_num_rows($result);
			
			//other label, for source-sinks
			$otherItem = new ChartItem("", "");
			$otherValue = 0;
			$otherId = "";
				
			for ($i = 0; $i < $num; $i++)
			{
				if ($this->actionType)
				{
					//for sources sinks
					$label = mysql_result($result, $i, "Name");
					$pid = mysql_result($result, $i, "ID");
				}
				else 
				{
					$label = mysql_result($result, $i, "FullDate");
				}
				
				$amount = mysql_result($result, $i, "Amount");
				
				$item = new ChartItem($label, $amount);
				if ($pid)
				{
					$item->pid = $pid;
				}
				
				if ($label == "Other")
				{
					//source-sinks
					$otherValue += $amount;
					$otherId .= $pid;
					$otherId .= ",";
				}
				else 
				{
					array_push($dataset, $item);	
				}
			}
			
			if ($otherValue != 0)
			{
				$otherId = substr($otherId, 0, strlen($otherId) - 1);
				
				$otherItem->chartLabel = "Other";
				$otherItem->chartValue = $otherValue;
				$otherItem->pid = $otherId;
				array_push($dataset, $otherItem);	
			}
			
			return $dataset;
		}
		
		function getCategories($dataset)
		{
			$result = "<categories>";
			
			for ($i = 0; $i < count($dataset); $i++)
			{
				
				$chartItem = $dataset[$i];
				
				$result .= "<category label=\"";
				$result .= $chartItem->chartLabel;
				$result .= "\"/>\n";
			}
			
			$result .= "</categories>";
			return $result;
		}
	}
?>