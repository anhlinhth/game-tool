<?php

class Models_S_Export_Logic
{
	
	private $path= ""; 
	
	public function  __construct()
	{
		$this->path = ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'file_export' . DS;
	}
	
	
	public function shop_version_xfj($string,$name) 
	{
		$fullpath= $this->path.$name;
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
	}
	
	public function ShopBuilding_conf_php($string) 
	{
		$fullpath= $this->path.'ShopBuilding.conf.php';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
	}
	
	public function ShopHero_conf_php($string) 
	{
		$fullpath= $this->path.'ShopHero.conf.php';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
	}
	
	public function ShopItem_conf_php($string) 
	{
		$fullpath= $this->path.'ShopItem.conf.php';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
	}
	
	public function ShopItemQuantity_conf_php($string) 
	{
		$fullpath= $this->path.'ShopItemQuantity.conf.php';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
	}
	
	public function ShopSoldier_conf_php($string) 
	{
		$fullpath= $this->path.'ShopSoldier.conf.php';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
	}
	
	public function Version_conf_php($string) 
	{
		$fullpath= $this->path.'Version.conf.php';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
	}
} 