<?php
	class PieHandler
	{
		private $rtype;
		private $dbHelper;
		
		function PieHandler()
		{
			include_once('Constants.php');	
			include_once('ChartItem.php');
			//include_once 'util/DBHelper.php';
			include_once('../util/DBHelper.php');
			
			$this->dbHelper = new DBHelper("SynDB");	
		}
		
		function genXml($rtype, $fromdate, $todate,$actionType,$moneyType,$numGroup,$numLvlFrom,$numLvlTo)
		{
			$this->rtype = $rtype;
			$dataset = $this->getData($rtype, $fromdate, $todate,$actionType,$moneyType,$numGroup,$numLvlFrom,$numLvlTo);
			
			$xml = "<chart caption=\"Sources vs Sinks\" subcaption=\"";
			//$xml .= $rtype;			
			$xml .= "\" palette=\"$numGroup\">\n";
			$xml .= $this->serializeDataSet($dataset);
			$xml .= "</chart>";
			
			return $xml;
		}
		
		function serializeDataSet($dataset)
		{
			$result = "";
			
			for ($i = 0; $i < count($dataset); $i++)
			{
				$chartItem = $dataset[$i];
				$chartLabel = $chartItem->chartLabel;
				$chartValue = $chartItem->chartValue;
				$pid = $chartItem->pid;
				
				$result .= "<set link=\"javascript:on_pie_click($chartValue,'$chartLabel', '$pid');\" value=\"";
				$result .= $chartItem->chartValue;
				$result .= "\" label=\"";
				$result .= $chartItem->chartLabel;
				$result .= "\"/>\n";
			}
			
			return $result;
		}
		
		function getData($rtype,$fromdate, $todate,$actionType,$moneyType,$numGroup,$numLvlFrom,$numLvlTo)
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
				$label = mysql_result($result, $i, "Name");
				$amount = mysql_result($result, $i, "Amount");
				$pid = mysql_result($result, $i, "ID");
				
				if ($label == "Other")
				{
					$otherValue += $amount;
					$otherId .= $pid;
					$otherId .= ",";
				}
				else
				{
					$item = new ChartItem($label, $amount);
					$item->pid = $pid;
				
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
	}
?>