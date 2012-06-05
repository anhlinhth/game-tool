<?php


/* Physical Paths */
define('DS', '/');
define('ROOT', dirname(__FILE__));

//FOR APPLICATION FOLDER
define('ROOT_APPLICATION', 							ROOT.DS.'application');
define('ROOT_APPLICATION_CONFIGS', 					ROOT_APPLICATION.DS.'configs');
define('ROOT_APPLICATION_CONTROLLERS', 				ROOT_APPLICATION.DS.'controllers');

define('ROOT_APPLICATION_MODELS', 					ROOT_APPLICATION.DS.'models');

define('ROOT_APPLICATION_VIEWS', 					ROOT_APPLICATION.DS.'views');
define('ROOT_APPLICATION_VIEWS_LAYOUTS', 			ROOT_APPLICATION_VIEWS.DS.'layouts');
define('ROOT_APPLICATION_VIEWS_LAYOUTS_EMAILS', 	ROOT_APPLICATION_VIEWS_LAYOUTS.DS.'emails');
define('ROOT_APPLICATION_FORMS', 					ROOT_APPLICATION.DS.'forms');
define('ROOT_APPLICATION_OBJECT', 					ROOT_APPLICATION.DS.'object');

define('ROOT_CONFIG', 								ROOT.DS.'configs');
define('ROOT_MEDIA', 								ROOT.DS.'media');
define('ROOT_LIBRARY',								ROOT.DS.'library');
define('ROOT_LIBRARY_EXCEPTION',					ROOT_LIBRARY.DS.'exception');
define('ROOT_LIBRARY_UTILITY',						ROOT_LIBRARY.DS.'utility');
define('ROOT_MEDIA_IMAGE',                          ROOT_MEDIA.DS.'images');
define('ROOT_MEDIA_IMAGE_UPLOAD',                   ROOT_MEDIA_IMAGE.DS.'upload');
define('ROOT_MEDIA_IMAGE_ITEM',                     ROOT_MEDIA_IMAGE.DS.'item');
define('ROOT_LANGUAGE',								ROOT.DS.'language');
define('ROOT_IMPORT_FILE',							ROOT.DS.'import_file_config');
define('ROOT_EXPORT_FILE',							ROOT.DS.'export_file_config');
define('ROOT_LOG',									ROOT.DS.'log');
define('LOG_FILE',									ROOT_LOG.DS."error.log");

define('BATTLE_PACKAGE_PHP_FILE',ROOT_EXPORT_FILE.DS.'Campaign'.DS.'Battle.conf.php.txt');
define('MAP_BATTLE_PACKAGE_PHP_FILE',ROOT_EXPORT_FILE.DS.'Campaign'.DS.'MapBattle.conf.php.txt');
define('MAP_PACKAGE_PHP_FILE',ROOT_EXPORT_FILE.DS.'Campaign'.DS.'Map.conf.php.txt');
define('QUEST_PACKAGE_PHP_FILE',ROOT_EXPORT_FILE.DS.'Quest'.DS.'Quest.conf.php.txt');
define('TASK_PACKAGE_PHP_FILE',ROOT_EXPORT_FILE.DS.'Quest'.DS.'Task.conf.php.txt');
define('QUEST_PACKAGE_XFJ_FILE',ROOT_EXPORT_FILE.DS.'Quest'.DS.'quest.xfj.txt');



define('ROLE_ADMIN', 	1);
define('ROLE_REPORT', 	2);
define('ROLE_POWER_USER', 3);

define("DEFAULT_ITEM_PER_PAGE", 50);
define("UPDATE", 		1);
define("INSERT", 		2);

define('TYPE_GOLD', 	1);
define('TYPE_EXP', 		2);


define('DEV', 			1);
define('LIVE', 			2);

?>
