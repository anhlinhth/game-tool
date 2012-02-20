<?php
	class ChartHelper
	{
		function ChartHelper()
		{
			
		}
		
		public static function getValue($keyValues, $key)
		{
			$pairs = split(";", $keyValues);
			
			for ($i = 0; $i < count($pairs); $i++)
			{
				$pair = $pairs[$i];
				$kv = split("=", $pair);
				
				if (count($kv) == 2)
				{
					if ($kv[0] == $key)
					{
						return $kv[1];
					}
				}
			}
			
			return "";
		}
	}
?>