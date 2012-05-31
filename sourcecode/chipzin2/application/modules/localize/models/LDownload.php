<?php
// require_once ROOT_APPLICATION_MODELS.DS.'Models_Base.php';

class Localize_Model_LDownload extends Base_Model
{
	public function getData() {
		
		//-------get folder to arr---------------------------------------------------------
		$arr = null;
		$num=1;
		foreach ( glob (ROOT."\Export"."/*.txt" ) as $key => $filename ) {
			$pieces = explode ( "/", $filename );
			$a = count ( $pieces ) - 1;
			$arr [$key] ['Name'] = $pieces [$a];
			$arr [$key] ['DateTime'] = date ( "d-m-Y H:i:s", filemtime ( $filename ) );
			$arr [$key] ['Num']=$num;
			$num++;
		}
		//=================================================================================
		
		
		//-------Order arr----------------------------------------------------------------
		
		
		for($n = 0; $n < count ( $arr ); $n ++) {
			for($f = 0; $f < count ( $arr ); $f ++) {
				if ($arr [$n]['DateTime'] > $arr [$f]['DateTime']) {
					
					$arr=$this->swap($n, $f, $arr);
				}
			}
		}
		
		//=================================================================================
		
		return $arr;
	}
	
	
	
	public function swap($a,$b,$arr)
	{
		$kq=$arr[$a];
		
		$arr[$a]=$arr[$b];
		$arr[$b]=$kq;
	
		return $arr;
	}
	
	

}