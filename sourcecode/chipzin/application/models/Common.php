<?php
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

class Common {
    
    public static function lock($key, $timeout = 20, $isWait=true)
    {
        $db = Utility::initMemCache();
        
        if($isWait)
        {
            $t = time();
            $waitTime = 5;//doi de thuc thi 5s
            //while($db->AddMem("{$key}_lock", true, false, $timeout) === false && time() - $t <= $waitTime)
            while($db->add("{$key}_lock", true, false, $timeout) === false && time() - $t <= $waitTime)
            {
                usleep(50000);
            }

            if (time() - $t > $waitTime)
            {
                return false;
            }
        }
        else
        {
            return $db->add("{$key}_lock", true, false, $timeout);
        }
        
        
        return true;
    }
    
    public static function unlock($key)
    {
        $db = Utility::initMemCache();
        return $db->delete("{$key}_lock");
    }
    
    public static function getUniqId()
    {
        //static $counter = 10;
        $fchar = mt_rand(1, 9);
        $genId = self::str_makerand(8, 8, false, false, true, false);
        $genId = $fchar . $genId;
        return $genId;
    }
    
    //KHIEMVT
    //Generate string
    public static function str_makerand ($minlength, $maxlength, $useupper, $usespecial, $usenumbers, $char = true)
    {
        if($char) $charset = "abcdefghijklmnopqrstuvwxyz";
        if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($usenumbers) $charset .= "0123456789";
        if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
        if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
        else $length = mt_rand ($minlength, $maxlength);
        for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
        return $key;
    }
}
?>
