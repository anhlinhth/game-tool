<?php
	class ChartItem
	{
		public $chartLabel;
		public $chartValue;
		public $pid;
		
		function ChartItem($label, $value)
		{
			$this->chartLabel = $label;
			$this->chartValue = $value;
		}
	}
?>