<?php
/**
* Class for defne application constant
* @author KietMA
*/
class AppConstant{
    const GIFT_TYPE_XU = 'xu';
    const GIFT_TYPE_GOLD = 'gold';
    const GIFT_TYPE_ITEM = 'item';
    const GIFT_TYPE_GROUPITEM = 'groupitem';
    const GIFT_TYPE_PIG = 'pig';
    const GIFT_TYPE_EXP = 'exp';
    const GIFT_TYPE_KISS = 'kiss';
    
    const COMPENSATION_WAITING = -1; // Cho duyet
    const COMPENSATION_DENIED = 0; // Khong duyet
    const COMPENSATION_APRROVED = 1; // Da duyet
    const COMPENSATION_EXECUTED = 2; // Da thuc thi
    
    const KEY_COMPENSATION = 'compensation_'; // compensation_<$playerId>
    
    const DATE_TIME_FORMAT = 'Y-m-d G:i:s';
    
    const CHAR_SET_UTF8 = 'UTF-8';
    
    const COMPENSATION_REASON_DENBU = 'denbu';
    const COMPENSATION_REASON_VANHANH = 'vanhanh';
    const COMPENSATION_REASON_KHAC = 'other';
    
    const TBL_IBS_ITEM = 'ibs_item';
    const TBL_IBS_PIG = 'ibs_pig';
}
?>
