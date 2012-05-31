<?php

/* Physical Paths */
define('DS', '/');
defined('ROOT')
    || define('ROOT', 
    		realpath(dirname(__FILE__)));   

//FOR APPLICATION FOLDER - ThaoNX

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
define('ROOT_MEDIA_IMAGE_ITEM_ITEMSHOP',            ROOT_MEDIA_IMAGE_ITEM.DS.'itemshop');
define('ROOT_BACKUP',           					ROOT_MEDIA_IMAGE_ITEM.DS.'itemgift');
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

define("DEFAULT_ITEM_PER_PAGE", 50);
define("UPDATE", 1);
define("INSERT", 2);

// CREATED IN 22/8/2011, BY : DINHLHN
?>
