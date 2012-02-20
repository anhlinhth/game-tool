<?php

/**
 * 
 * Constant class
 * @author KietMA
 *
 */
class GameConstant 
{
	const ITEM_EFFECT_CHUA_BENH = 'CHUA_BENH';
    const ITEM_EFFECT_THUOC_BO = 'THUOC_BO';
	const ITEM_EFFECT_GAY_BENH = 'GAY_BENH';
	const ITEM_EFFECT_HOI_SINH = 'HOI_SINH';
	const ITEM_EFFECT_TANG_CAN = 'TANG_CAN';
	const ITEM_EFFECT_TI_LE_TANG_CAN = 'TI_LE_TANG_CAN';
	const ITEM_EFFECT_NEN_CHUONG = 'NEN_CHUONG';
	const ITEM_EFFECT_PHONG_CANH = 'PHONG_CANH';
	const ITEM_EFFECT_BAI_CO = 'BAI_CO';
	const ITEM_EFFECT_ARCH_STYLE = 'ARCH_STYLE';
	const ITEM_EFFECT_TRANG_TRI_MU = 'TRANG_TRI_MU';
	const ITEM_EFFECT_BO_TRANGTRI = 'BO_TRANGTRI';
	const ITEM_EFFECT_HANGRAO = 'HANG_RAO';
	const ITEM_EFFECT_CHUONG_CHO = 'CHUONG_CHO';
	const ITEM_EFFECT_XUONG_CHE_BIEN = 'XUONG_CHE_BIEN';
	const ITEM_EFFECT_MANG_AN = 'MANG_AN';
	const ITEM_EFFECT_VOI_TAM = 'VOI_TAM';
	const ITEM_EFFECT_CHUONG_HEO = 'CHUONG_HEO';
    const ITEM_EFFECT_SINH_NHANH = 'SINH_NHANH';
    const ITEM_EFFECT_TRUONG_THANH_NHANH = 'TRUONG_THANH_NHANH';
    const ITEM_EFFECT_TANG_TUOI_THO = 'TANG_TUOI_THO';
    const ITEM_EFFECT_NAP_NANG_LUONG = 'NAP_NANG_LUONG';
    const ITEM_EFFECT_THUC_AN_CHO = 'THUC_AN_CHO';
    const ITEM_EFFECT_THUOC_TINH_LUYEN = 'HOLY_MEDICINE';
    const ITEM_EFFECT_PICEVENT = 'ITEM_EFFECT_PICEVENT';
    const ITEM_EFFECT_PACKAGE = 'ITEM_EFFECT_PACKAGE';
    const ITEM_EFFECT_LAM_BANH_NL = 'LAM_BANH_NL';
    const ITEM_EFFECT_GIFT_PACKAGE = 'ITEM_GIFT_PACKAGE';
    const ITEM_EFFECT_KILEVENT = 'ITEM_EFFECT_KILEVENT';
	const PIG_BEGET_LIMITATION = 1; // SO LAN GIAO PHOI TOI DA
    
	
	/**
	 * MINHVH
	 * 16/02/2011
	 */
	const ITEM_TYPE_DECORATING 	= 2; // item trang tri
	const ITEM_TYPE_EQUIPMENT	= 4; // Item ngoai trang cho heo
	const ITEM_TYPE_DRUG		= 3;
	const ITEM_TYPE_FOOD		= 1;
	const ITEM_TYPE_PIG			= 5;
	const ITEM_TYPE_ITEM_SET	= 6;
    const ITEM_TYPE_TRUNGTHU_LAMBANH = 7;
    const ITEM_TYPE_GIFT_PACKAGE = 8; // Gift package
	const ITEM_TYPE_KIMINLENH = 9; // Kim in lenh
	const ITEM_TYPE_TRIAN_LAMTHIEP = 10;
    const ITEM_TYPE_KISS = 13;
    const DIARY_ROWS = 100;
    const MESSAGE_ROWS = 30;
    const NEWS_ROWS = 10;
    const MESSAGE_LENGTH = 1000;
	
	const DIARY_OBJ_PIG			= 1;
	const DIARY_OBJ_ITEM		= 2;
	const DIARY_OBJ_GROUP_ITEM	= 3;
	const DIARY_OBJ_ITEM_SET	= 4;
	
	const DIARY_CURRENCY_XU		= 2;
	const DIARY_CURRENCY_GOLD	= 1;
	
	const PURPOSE_HO_TRO		= 0;
	const PURPOSE_PHA_HOAI		= 1;
	
	//Diary Action
	const DIARY_ACT_BUY				= 1;
	const DIARY_ACT_SELL			= 2;
	const DIARY_ACT_STEAL			= 3;
	const DIARY_ACT_BATH			= 4;
	const DIARY_ACT_FEED			= 5;  // Cho an
	const DIARY_ACT_MASSAGE			= 6;
	const DIARY_ACT_VISIT			= 7;
	const DIARY_ACT_GIFT			= 8;  // lum qua	
	const DIARY_ACT_SICK			= 10; // Gay benh
	const DIARY_ACT_BEGET			= 11; // Phoi giong	
	const DIARY_ACT_ANSWER_QUESTION = 12;
	const DIARY_ACT_HEATH			= 13;
	const DIARY_ACT_SEND_DIGPIG		= 14;
    const DIARY_ACT_EVENT_BUBBLE    = 15;
    const DIARY_ACT_EVENT_PICTURE   = 16;
    const DIARY_ACT_EVENT_CAROT     = 17; // trồng cà rốt
    const DIARY_ACT_EVENT_GIFT_TEM     = 18; // tặng tem cho quà tặng hàng ngày có phí
    const DIARY_ACT_EVENT_FLOWER     = 19; // trồng cà rốt
	const DIARY_ACT_COMPESATION = 20; // He thong den bu
	/*
	 * Type of cache and db
	 */
	const STYPE_CACHE_STATE = 1;
	const STYPE_CACHE_SNS = 2;
	const STYPE_CACHE_GP = 3;
	const STYPE_DB = 4;
    const STYPE_DB_EVENT = 5;
    const STYPE_CACHE_GP1 = 6;
	
	/*
	 * Expire time
	 */
	const ETIME_10MINUTES = 600;
    const ETIME_ONE_HOUR = 3600;
    const ETIME_6_HOURS = 21600;
    const ETIME_12HOURS = 43200;
	const ETIME_24HOURS = 86400;
	
	/*
	 * Key cache
	 */
	
	const KEY_USER_INFO = 'UI';
	const KEY_SNS_INFO = 'SI';
	const KEY_FRIEND_LIST = 'FL';
	
	/*
	 * Key DB
	 */
	const DB_GAME_INFO = 'user_';
	
	const PIG_GIFT_CONDITION = 10800;//3*60*60
	const LAG_TIME = 60;
	const SPECIAL_PIG_TN_TIME_CONDITION = 1;
	const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
	const SPECIAL_PIG_TN_CONDITION = 24;
	const GIFT_TYPE_PIG_EAT = 1;
	const GIFT_TYPE_PIG_TN_HIGH = 2;
	const GIFT_TYPE_PIG_TN_LOW = 3;
    const GIFT_TYPE_SPECIAL = 4;
    const GIFT_FRIEND_GOLD_RATE = 0.2;
    const SPECIAL_GIFT_CONDITION = 12;//nhan qua vao 12h trua
    const INIT_MAX_PIG = 5;
    const PIG_SICK = 20;
    const GIFT_EXP = 'exp';
    const GIFT_COIN = 'coin';
    const GIFT_GOLD = 'gold';
    const GIFT_PIG = 'pig';
    const GIFT_GROUP_ITEM = 'groupitem';
    const GIFT_ITEM = 'item';
    const GIFT_CARD = 'card'; // The bai
    const GIFT_KISS = 'kiss';
    const GIFT_KIL = 'kil'; // Kim in lenh
    const GIFT_XU = 'xu';
    //const GIFT_DAILY_LOTTERY = 'lottery'; // Quay so khi thuc hien quest hang ngay
    
    const ACT_EAT = 'eat';
    const ACT_BATH = 'bath';
    const ACT_MASSAGE = 'massage';
    const ACT_HEAL = 'heal';
    const ACT_BREED = 'breed';
    const ACT_SELL = 'sell';
    const ACT_PICK_GIFT = 'pickgift';
    const ACT_PIG_DECORATION = 'pigdecoration';
    const ACT_ANSWER_QUESTION = 'answerQuestion';
    const ACT_TN = 'tn';
    //const ACT_EVENT_PICTURE = 'picture';old
    const ACT_EVENT_PICTURE = 'picturenewOct';
    const ACT_EVENT_KISS = 'eventkiss';
    
    const ACT_CHANGE_PIG_NAME = 'changepigname';
    const ACT_BUY_PIG = 'buypig';
    const ACT_BUY_FOOD = 'buyfood';
    const ACT_BUY_MEDICAL = 'buymedical';
    const ACT_PIG_GIFT_FRIEND = 'pickgiftfriend';
    const ACT_VISIT_FRIEND = 'visitfriend';
    const ACT_DRIND = 'drink';
    const ACT_SET_FORMATION = 'setformation';
    const ACT_QUEUE_UP = 'queueup';
    const ACT_EAT_FRIEND = 'eatfriend'; // CHO HEO BAN BE AN
    const ACT_EXPENSE_GOLD = 'expensegold'; // TIEU VANG
    const ACT_TX_HOME_FREE = 'txhomefree';
    const ACT_TX_HOME_FEE = 'txhomefee';
    const ACT_TX_FRIEND = 'txfriend';
    
    const ACT_TN_HOME_FREE = 'tnhomefree';
    const ACT_TN_HOME_FEE = 'tnhomefee';
    const ACT_TN_FRIEND = 'tnfriend';
	
	//Pikaheo
	const ACT_PIKA_HOME_FREE	= 'pikahomefree';
	const ACT_PIKA_HOME_FEE		= 'pikahomefee';
	const ACT_PIKA_FRIEND		= 'pikafriend';
	
	 const PIKAHEO_FREE_TIME_HOME = 2;
     const PIKAHEO_FEE_TIME_HOME = 3;
     const PIKAHEO_FEE_TIME_FRIEND = 1;
	 const PIKAHEO_COIN = 3;
	 const PIKAHEO_COIN_NEXT_LEVEL = 1;
	 const PIKAHEO_SUPPORT_COINT = 1;
	 const PIKAHEO_SUPPORT_SEARCH = 2;
	 const PIKAHEO_SUPPORT_REFRESH = 1;
	 const PIKAHEO_SEARCH_CONTROL = 1;
	 const PIKAHEO_REFRESH_CONTROL = 2;
	 
	 const PIKAHEO_SUCCESS_5LEVEL	= 1;
	 const PIKAHEO_LOSE				= 2;
	 const PIKAHEO_NEXT_LEVEL		= 3;
    
    const ACT_GIFT_FEE = 'giftfee';
    const ACT_FRIEND_REC_GIFT = 'giftfee';
    
    const ACT_HOLY_PIGS_COLLECTION = 'holypigscollection';

    const TN_CONDITION = 12;//RESET LAI SO CAU HOI VAO 12H TRUA
    const NUM_QUESTION_PER_DAY = 10;//10 CAU HOI MOI NGAY
    
    
    /**
     * Quest
     */
    const QUEST_STATUS_ACCEPT 		= -4;
    const QUEST_STATUS_DISCARD		= -3;
    const QUEST_STATUS_CANCEL 		= -2;
    const QUEST_STATUS_COMPLETED 	= -1;
    
    /**
     * Truc xanh
     * @author dinhlhn
     */
     const TX_CONDITION = 12;//RESET LAI TRUC XANH NHA MINH VAO 12H TRUA

     const TRUCXANH_FREE_TIME_HOME = 2;
     const TRUCXANH_FEE_TIME_HOME = 3;
     const TRUCXANH_FEE_TIME_FRIEND = 1;
     const TRUCXANH_STEP_TIME_OUT = 1000;
     const TRUCXANH_TIME_OUT = 60;
     const TRUCXANH_COIN = 3; //// GIA CHOI TRUC XANH
     const TRUCXANH_DELAY_TIME = 5; /// THOI GIAN DELAY SAU KHI HOAN THANH TRUC XANH
     const TRUCXANH_MAX_TIMES_FLIP = 120; // MAX SO LAN LAT THE
     const TRUCXANH_MAX_CARD = 24; // SO THE LAT TRUC XANH TOI DA LA 24 THE
     
     const TRANGNGUYEN_COIN = 1; //// GIA CHOI TRANG NGUYEN
     const TRANGNGUYEN_FEE_TIME_HOME = 5;
     const TRANGNGUYEN_NUM_QUESTION = 5; 
     const HOUR_CONDITION_12 = 12;
     const HOUR_CONDITION_6 = 6;
     const HOUR_CONDITION_4 = 4;
     const HOUR_CONDITION_24 = 0;  //reset lúc 12h trưa
     
     //them trong the bai nho vao file config DropItem.php them vao
     const CARD_TYPE_THE_BAI = 1;
     const CARD_TYPE_DANH_THIEP = 2;
     const CARD_TYPE_CUON_TRANH = 13;
     const CARD_TYPE_LONGDEN = 14;
     const CARD_TYPE_NEN = 15;
     const CARD_TYPE_TRONGLAN = 16;
     const CARD_TYPE_DAULAN = 17;
     const CARD_TYPE_BOT = 18;
     const CARD_TYPE_DAU = 19;
     const CARD_TYPE_TRUNG = 20;
     const CARD_TYPE_CAROT = 21;
     const CARD_TYPE_THU_THAP = 22;
     const CARD_TYPE_DONG_GOP = 23;
     const CARD_TYPE_KIM_IN_LENH = 24;
	 const CARD_TYPE_DAYTHUNG = 25;			//Event Tri An
	 const CARD_TYPE_HATTRANGTRI = 26;		//Event Tri An
	 const CARD_TYPE_GIAY3MAU = 27;			//Event Tri An
	 const CARD_TYPE_TEM = 28;				//Event Tri An
     const CARD_TYPE_FLOWER = 29;                //Event Trồng hoa
	 
	 /**
	  * Log Tui huong
	  * @author MINHVH
	  */
	 const TUIHUONG_GET_CARD			= 1;
	 const TUIHUONG_SEND				= 2;	
	 const TUIHUONG_OPEN_GIFT			= 3;
	 const TUIHUONG_OPEN_SPECIAL_GIFT	= 4;
	 
	 const TUIHUONG_REWARD_TYPE_GOLD	= 1;
	 const TUIHUONG_REWARD_TYPE_XU		= 2;	
	 const TUIHUONG_REWARD_TYPE_EXP		= 3;
	 const TUIHUONG_REWARD_TYPE_ITEM	= 4;
	 
	 /**
	  * Flag log
	  */
	 const FLAG_LOG_OPEN_GIFT			= false;
	 const FLAG_LOG_MASSAGE_PIG			= false;
	 const FLAG_LOG_ANSWER_QUESTION		= true;
	 const FLAG_LOG_BATH_PIG			= true;
	 const FLAG_LOG_FEED_PIG			= true;
	 const FLAG_LOG_LOADING				= true;
	 const FLAG_LOG_NHAT_TUI_HUONG		= false;
	 const FLAG_LOG_EVENT_TUI_HUONG		= true;
	 const FLAG_LOG_DAILY_QUEST			= true;
	 const FLAG_LOG_KISS_PIG			= true;
	 const FLAG_PLAY_LOTTERY			= true;
	 const FLAG_BUBBLE					= true;
     const FLAG_LOG_QUEST_THU_THAP        = true;
     const FLAG_LOG_VE_TRANH        = true;
     const FLAG_LOG_TANG_QUA        = true;
     const FLAG_LOG_DAILY        = true;
     const FLAG_LOG_PIKAHEO = true;
     const FLAG_LOG_TRUNG_THU = true;
     const FLAG_LOG_X_HEO = true; //Tien thai
     const FLAG_LOG_OPEN_DAILY_GIFT = true; //Nhan qua hang ngay
     const FLAG_LOG_USE_CANDY = true; //dung keo bon bon
     const FLAG_LOG_KIM_IN_LENH = true;
     const FLAG_LOG_BAT_HEO = true;
     const FLAG_LOG_TINH_CHE_THUOC = true;
     const FLAG_LOG_XAI_DE_LENH = true;
     const FLAG_LOG_LAM_THIEP_TRI_AN = true;
     const FLAG_LOG_TINH_LUYEN_NGOAI_TRANG = true;
     const FLAG_LOG_TRONG_HOA = true;
     const FLAG_LOG_PUSH_FEED = true;
     const FLAG_RESET_COIN_PIG = true;

	 const FUNCTION_LOADING_CLIENT		= 1;
	 
	 const DAILY_QUEST_ACCEPT			= 1;
     const PIG_GIFT_SUBGOLD           = 0;
     const CREATE_GUILD_FEE = 100000;
     
     const DAILY_QUEST_MIN_LEVEL = 1; // Dieu kien toi thieu de lam quest hang ngay
     const DAILY_QUEST_RANGE1_LEVEL = 36;
     const DAILY_QUEST_RANGE2_LEVEL = 81;
     const COMMON_CONDITION_HOUR = 12;
     const MAXIMUM_PIG_QUANTITY = 30;  /// so luong heo toi da trong chuong
     const MLQUEST_MASSAGE = 'MLQMassage';
     const MLQUEST_PICKGIFT = 'MLQPickgift';
     const MLQUEST_ACTION_PROGRESS_STARTED = 0;
     const MLQUEST_ACTION_PROGRESS_COMPLETED = 1;
     
     const GIFT_FEE_RECV_NOW_COIN = 3;   // tang wa co phi, so xu phai tra khi dong y nhan wa ngay
     
     const HOLYFETUS_SUPPORT_MEDICIEN_MAXSLOT   =   3; // Maximum holy support medicein slot
// Th? ng?c
     const ACT_THONGOC_FRIEND = 'thongocfriend';
     const ACT_THONGOC_HOME_FREE = 'thongochomefree';
     const ACT_THONGOC_HOME_FEE = 'thongochomefee';
     const THONGOC_WIN = 'win';
     const THONGOC_LOSE = 'lose';
 	 const THONGOC_FEE_QUANTITY = 3;
     const THONGNGOC_COIN_PRICE = 3;
     
     // Heo đại hiệp
     const ACT_DAIHIEP_HOME_FREE = 'daihiephomefree';
     const ACT_DAIHIEP_HOME_FEE = 'daihiephomefee';
     const ACT_DAIHIEP_FRIEND = 'daihiepfriend';
     
     // Heo thần tài
     const ACT_THANTAI_HOME_FREE = 'thantaihomefree';
     const ACT_THANTAI_HOME_FEE = 'thantaihomefee';
     const ACT_THANTAI_FRIEND = 'thantaifriend';

  //[20/07/2011: duytn]
     //??nh nghia ki?u thu?c t?nh v?t ph?m ngo?i trang
     const ITEM_ADD_WEIGHT_SELL = 1;
     const ITEM_ADD_EXP_SELL = 2;
     const ITEM_ADD_GOLD_SELL = 3;
     const ITEM_ADD_WEIGHT_PER_HOUR = 4;
     const ITEM_ADD_EXP_PER_HOUR = 5;
     const ITEM_ADD_GOLD_PER_HOUR = 6;

     const MIN_ITEM_EFFECT_TIME = 3600; // time toi thieu dat duoc de tinh su dung ngoai trang cong nang (second)
     const MAX_ITEM_EFFECT_TIME = 108000; // time toi da de tinh su dung ngoai trang cong nang (second)
          
     const LEVEL_CREATE_GUILD = 50;
     
     // dau gia
     const AUCTION_ID_TICKET = 130; // ID cua phieu dau gia
     const AUCTION_NUMBER_TOP = 50; // ID cua phieu dau gia
     
     // Minigame bat heo
     const CATCH_PIG_LIMIT_TIMES = 3;
     const CATCH_PIG_MAXEXP = 6000;
     const CATCH_PIG_NUM_GOT_PIG = 10;
     const CATCH_PIG_EXP_BLACK_PIG = 100;
     const CATCH_PIG_EXP_WHITE_PIG = 20;
     const CATCH_PIG_SPECIAL_PIG_TYPE = 'DarthVader_1';
     
     //Paging top guild
     const PAGE_COUNT = 10;
     const PAGE_CACHE_COUNT = 100;
     
     //money type
     const MONEY_TYPE_OUTGAME = 0;
     const MONEY_TYPE_INGAME = 1;
     const MONEY_TYPE_FREE = 2;
     
     const DELENH_ID = 760;
     
     const QTY_CARD_GIFT_FEE = 1;  // so luong tem gui tang cho su kien tri an
     const DAYS_EMPTY_COIN = 180;
	 
	 //Mo rong chuong	 
	 const OPEN_PIGSTY_TYPE_ISLAND	= 1;
	 const OPEN_PIGSTY_TYPE_HELL	= 2;
	 const OPEN_PIGSTY_TYPE_HEAVEN	= 3;
	 const DEFAULT_PIGSTY			= 0;
	///Trigger button key
     const TRIGGER_TUIHUONG='tuiHuong';
     const TRIGGER_GIFT='gift';
     const TRIGGER_XHEO='xheo';
	//range hun heo
	const KISS_MIN_LEVEL = 1; 
     const KISS_RANGE1_LEVEL = 51;
     const KISS_RANGE2_LEVEL = 91;
     
     const KISS_HHXH_FEE = 3;
	 const OPEN_PIGSTY_CONDITION1	= 1;
	 const OPEN_PIGSTY_CONDITION2	= 2;
}
?>
