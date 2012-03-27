<?php
define('MEMCACHE_ADDRESS', '127.0.0.1');
define('MEMCACHE_PORT', 11212);
define('MEMBASE_ADDRESS', '127.0.0.1');
define('MEMBASE_PORT', 11211);

define('IMAGE_URL_DEV','http://10.30.9.118');
define('URL_IMAGE_POPUP_DEV', IMAGE_URL_DEV.'/uploadimage/');
define('URL_IMAGE_ITEMGIFT_DEV', IMAGE_URL_DEV.'/uploadimage/itemgift');

define('IMAGE_URL_LIVE','http://10.30.9.118');
define('URL_IMAGE_POPUP_LIVE', IMAGE_URL_LIVE.'/uploadimage/');
define('URL_IMAGE_ITEMGIFT_LIVE', IMAGE_URL_LIVE.'/uploadimage/itemgift');

define('LOG_SERVER', '10.30.9.118');
define('LOG_PORT', 1463);
define('LOG_FOLDER', 'local_dev');

/* Physical Paths */
define('DS', '/');
define('ROOT', dirname(dirname(dirname(__FILE__))));

//FOR APPLICATION FOLDER
define('ROOT_APPLICATION', 							ROOT.DS.'application');
define('ROOT_APPLICATION_CONTROLLERS', 				ROOT_APPLICATION.DS.'controllers');

define('ROOT_APPLICATION_MODELS', 					ROOT_APPLICATION.DS.'models');

define('ROOT_APPLICATION_VIEWS', 					ROOT_APPLICATION.DS.'views');
define('ROOT_APPLICATION_VIEWS_LAYOUTS', 			ROOT_APPLICATION_VIEWS.DS.'layouts');
define('ROOT_APPLICATION_VIEWS_LAYOUTS_EMAILS', 	ROOT_APPLICATION_VIEWS_LAYOUTS.DS.'emails');
define('ROOT_APPLICATION_FORMS', 					ROOT_APPLICATION.DS.'forms');
define('ROOT_APPLICATION_OBJECT', 					ROOT_APPLICATION.DS.'object');

define('ROOT_CONFIG', 								ROOT.DS.'config');
define('ROOT_MEDIA', 								ROOT.DS.'media');
define('ROOT_LIBRARY',								ROOT.DS.'library');
define('ROOT_LIBRARY_EXCEPTION',					ROOT_LIBRARY.DS.'exception');
define('ROOT_LIBRARY_UTILITY',						ROOT_LIBRARY.DS.'utility');
define('ROOT_LIBRARY_UTILITY_SCRIBE',               ROOT_LIBRARY_UTILITY.DS.'scribe');
define('ROOT_MEDIA_IMAGE',                          ROOT_MEDIA.DS.'images');
define('ROOT_MEDIA_IMAGE_UPLOAD',                   ROOT_MEDIA_IMAGE.DS.'upload');
define('ROOT_MEDIA_IMAGE_PIG',                      ROOT_MEDIA_IMAGE.DS.'pig');
define('ROOT_MEDIA_IMAGE_ITEM',                     ROOT_MEDIA_IMAGE.DS.'item');
define('ROOT_MEDIA_IMAGE_ITEM_ITEMGIFT',            ROOT_MEDIA_IMAGE_ITEM.DS.'itemgift');

define('ROOT_UPLOAD',								ROOT.DS.'upload');
define('ROOT_LANGUAGE',								ROOT.DS.'language');
define('ROOT_FILE',									ROOT.DS.'file');
define('ROOT_IMPORT_FILE',							ROOT.DS.'import_file_config');
define('ROOT_EXPORT_FILE',							ROOT.DS.'export_file_config');
define('ROOT_BAT',									ROOT.DS.'bat');
define('ROOT_XML',									ROOT.DS.'xml');
define('ROOT_UPLOADCONFIG',                         ROOT.DS.'uploadconfig');
define('ROOT_UPLOADXML',                            ROOT.DS.'uploadxml');

define('ROOT_LOG',									ROOT.DS.'log');
define('LOG_FILE',									ROOT_LOG.DS."error.log");

define('ROLE_ADMIN', 1);
define('ROLE_REPORT', 2);
define('ROLE_POWER_USER', 3);

define("DEFAULT_ITEM_PER_PAGE", 100);
define("UPDATE", 1);
define("INSERT", 2);

// CREATED IN 22/8/2011, BY : DINHLHN
// FOR SHOP EDITOR
define('ROOT_APPLICATION_OBJECT_MANAGER',           ROOT_APPLICATION_OBJECT.DS.'manager');


define('TYPE_GOLD', 1);
define('TYPE_EXP', 2);

//Name of config files
define('QUEST_PACKAGE_PHP_FILE',ROOT_EXPORT_FILE.DS.'Quest.conf.php.txt');
define('TASK_PACKAGE_PHP_FILE',ROOT_EXPORT_FILE.DS.'Task.conf.php.txt');
define('QUEST_PACKAGE_XFJ_FILE',ROOT_EXPORT_FILE.DS.'quest.xfj.txt');
define('EVENT_GOLD_EXP_PHP_FILE',ROOT_FILE.DS.'ExpEvent.php');
define('EVENT_NAMTHIEN_PHP_FILE',ROOT_FILE.DS.'EventKimInLenh.php');
define('GIFT_PACKAGE_PHP_FILE',ROOT_FILE.DS.'GiftPackageTool.php');
define('ITEM_TOOL_PHP_FILE',ROOT_FILE.DS.'ItemTool.php');
define('SALEOFF_SHOP_PHP_FILE',ROOT_FILE.DS.'GiftSaleOff.php');
define('XML_PATH', ROOT_XML.DS.'ConfigShop.xml');   // file config.xml
define('PIG_PHP', ROOT_UPLOADCONFIG.DS.'NewPig.php');   // file pig.php
define('ITEM_PHP', ROOT_UPLOADCONFIG.DS.'NewItem.php');   // file item.php
define('POPUP_PHP_FILE', ROOT_FILE.DS.'Popup.php');   // file Popup.php
define('TRANSFER_BAT_DEV', ROOT_BAT.DS.'transfer_dev.bat');
define('TRANSFER_BAT_LIVE', ROOT_BAT.DS.'transfer_live.bat');
define('TRANSFER_IMG_BAT_DEV', ROOT_BAT.DS.'TransferImage_dev.bat');
define('TRANSFER_IMG_BAT_LIVE', ROOT_BAT.DS.'TransferImage_live.bat');
define('TRANSFER_CONFIG_BAT', ROOT_BAT.DS.'transferConfig.bat');
define('TRANSFER_ITEMGIFT_IMG_BAT_DEV', ROOT_BAT.DS.'TransferImageGift_dev.bat');
define('TRANSFER_ITEMGIFT_IMG_BAT_LIVE', ROOT_BAT.DS.'TransferImageGift_live.bat');

define('FTP_USER','ftpuser');
define('FTP_PASSWORD', 'ftpuser');
define('FTP_CONFIG_DIR', '/var/www/html/test');
		
define('IS_SYNC', true);
define('GIFT_TYPE_REWARD', 1);
define('GIFT_TYPE_SELLOFF', 2);
define('ITEM_TYPE_GIFT', 8);
define('ITEM_TYPE_THUCPHAM', 1);
define('ITEM_TYPE_NGOAICANH', 2);
define('ITEM_TYPE_VATPHAMBOTRO', 3);
define('ITEM_TYPE_NGOAITRANG', 4);
define('ITEM_TYPE_TINHLUYEN', 6);
define('ITEM_TYPE_TRUNGTHU', 7);
define('ITEM_TYPE_KIMINLENH', 9);
define('ITEM_TYPE_TRIAN', 10);

define('DEV', 1);
define('LIVE', 2);

define('FTP_CONFIG_PATH_DEV', '/var/www/html/ppamf/configs/');
define('FTP_CONFIG_PATH_LIVE','/home/www/webroots/configs/'); //For server 10.30.48.3
//backup config before sync data
define('SERVER_BACKUP_LIVE', '10.30.48.3');
define('SERVER_BACKUP_DEV', '10.30.9.118');
?>
