<?php
require_once ROOT_APPLICATION . DS . 'modules' . DS . 'shop' . DS . 'models' . DS . 'Models_S_version.php';

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
		return 1;
	}
	
	public function ShopBuilding_conf_php($string) 
	{
		$fullpath= $this->path.'ShopBuilding.conf.php.txt';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
		return 1;
	}
	
	public function ShopHero_conf_php($string) 
	{
		$fullpath= $this->path.'ShopHero.conf.php.txt';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
		return 1;
	}
	
	public function ShopItem_conf_php($string) 
	{
		$fullpath= $this->path.'ShopItem.conf.php.txt';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
		return 1;
	}
	
	public function ShopItemQuantity_conf_php($string) 
	{
		$fullpath= $this->path.'ShopItemQuantity.conf.php.txt';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
		return 1;
	}
	
	public function ShopSoldier_conf_php($string) 
	{
		$fullpath= $this->path.'ShopSoldier.conf.php.txt';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
		return 1;
	}
	
	public function Version_conf_php($string) 
	{
		$fullpath= $this->path.'Version.conf.php.txt';
		$handle = fopen($fullpath,'w');
		fwrite($handle,$string);	
		fclose($handle);
		return 1;
	}
	
	public function getName_shopClient()
	{
		$mdVer= new Models_S_version();
		$ver=$mdVer->getVer();
		$name = 'shop.'.$ver[0]['Version'].'.xfj.txt';
		return $name;
	}
	
	public function updateVer()
	{
	$mdVer= new Models_S_version();
	$mdVer->updateVer();
	}
} 