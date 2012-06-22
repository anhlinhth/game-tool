<?php 
include_once 'Define.def.php';

$arr=get_defined_constants(TRUE);

$a.="<?php return array( ";
$handle = fopen('D:\003\xampp\htdocs\vng\game-tool\sourcecode\chipzin\import_file_config\define.php','w');
foreach($arr['user'] as $key=>$value)
{
	if(empty($value))
	$a.="'".$key."' => NULL ,";
	else
	$a.="'".$key."' => '".$value."' ,";
	
}
$a.="); ?>";
fwrite($handle,$a);
fclose($handle);
?>