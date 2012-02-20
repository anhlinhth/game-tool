<?php
require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Models_SaleOff_Shop extends Models_Base
{
	public function __construct()
	{
		parent::__construct();		
		$this->_key = "item_id";
		$this->_table = "saleoff_shop";		
	}
	
	public static function generateSaleOffShop($data)
	{
		$str .= "<?php\nreturn array(";		
		if($data)
		{
			$i = 1;
			foreach($data as $row)
			{
				$str .= "\n\t$row->item_id,";
			}
			$i++;
		}
		
		$str .= "\n\n);\n?>";		
		
		$fp = fopen(SALEOFF_SHOP_PHP_FILE, 'w');
		if(fwrite($fp, $str) === false)
		{
			return false;
		}
		fclose($fp);
		return true;
	}
}
?>
