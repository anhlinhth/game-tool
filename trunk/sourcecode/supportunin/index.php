<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

require_once ('library/define/define.php');

set_include_path('.'. PATH_SEPARATOR . get_include_path() . PATH_SEPARATOR . ROOT.'/library/Zend1.6');
require_once 'Zend/Loader.php';

Zend_Loader::registerAutoload();




$dbCfg = new Zend_Config_Ini(ROOT_CONFIG.DS.'config.ini', 'db');
Zend_Registry::set('config', $dbCfg);
$db = Zend_Db::factory($dbCfg->db);

$db->query("SET NAMES 'utf8'");
Zend_Registry::set('db', $db);

$frontController = Zend_Controller_Front::getInstance();
$frontController->registerPlugin(new Zend_Controller_Plugin_ErrorHandler());
$frontController->throwExceptions(true);
$frontController->setControllerDirectory(ROOT_APPLICATION_CONTROLLERS);

Zend_Layout::startMvc(array('layoutPath' => ROOT_APPLICATION_VIEWS_LAYOUTS));

$writer = new Zend_Log_Writer_Firebug();
$logger = new Zend_Log($writer);
Zend_Registry::set('logger',$logger);

$frontController->dispatch();