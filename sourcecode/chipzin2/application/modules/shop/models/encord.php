<html xmlns="http://www.w3.org/1999/xhtml">

<head>

 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>?n ?n Support</title>
</head>
<?php
function prepareJSON($input) {
    
    //This will convert ASCII/ISO-8859-1 to UTF-8.
    //Be careful with the third parameter (encoding detect list), because
    //if set wrong, some input encodings will get garbled (including UTF-8!)
    $imput = mb_convert_encoding($input, 'UTF-8', 'ASCII,UTF-8,ISO-8859-1');
    
    //Remove UTF-8 BOM if present, json_decode() does not like it.
    if(substr($input, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) $input = substr($input, 3);
    
    return $input;
}

//Usage:
$myFile = file_get_contents('860');
$myDataArr = json_decode(prepareJSON($myFile), true);

var_dump($myDataArr);
?>
