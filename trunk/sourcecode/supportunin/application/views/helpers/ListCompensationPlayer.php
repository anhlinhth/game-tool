<?php
class Zend_View_Helper_ListCompensationPlayer
{
    public function listCompensationPlayer($datas,$view)
    {
        if($datas == "")
        {
            $strList = '<div id="openFile"> 
                <label for="uploadImage" >Upload hình :</label>
                <input id="file" name="file" type="file" />
                <br />
                </div>';
            echo $strList ;
            return;
        }    
        $i = 0;
        foreach($datas as $data)
        {
            echo $data;
           /* $temp = explode(":", $row);
            $strList .= '<div id="dv_akiss_'. $i .'">Mua <input type="text" name="txtKiss[]" value="'. $temp[0] .'" style="width: 30px"/> nụ hôn được <input type="text" value="'. $temp[1] .'" name="txtKissCard[]" style="width: 30px"/> Kim Ỉn Lệnh&nbsp;&nbsp;&nbsp;&nbsp;<a name="akiss_'.  $i .'" onclick="deleteOption(this)" title="Xóa" href="javascript:;"><img src="'. $view->baseUrl .'/media/images/icons/delete.gif" /></a></div>';
            $i++;  */
        }
        
        echo $strList;
    }
}
?>
