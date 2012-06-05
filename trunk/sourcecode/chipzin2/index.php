<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

require_once ('define.php');

set_include_path('.'. PATH_SEPARATOR . get_include_path() . PATH_SEPARATOR . ROOT.'/library');
require_once 'Zend/Loader.php';

Zend_Loader::registerAutoload();


$dbCfg = new Zend_Config_Ini(ROOT_APPLICATION_CONFIGS.DS.'application.ini', 'db');
Zend_Registry::set('config', $dbCfg);
$db = Zend_Db::factory($dbCfg->db);

$db->query("SET NAMES 'utf8'");
Zend_Registry::set('db', $db);

$frontController = Zend_Controller_Front::getInstance();
$frontController->registerPlugin(new Zend_Controller_Plugin_ErrorHandler());
$frontController->throwExceptions(true);

$frontController->setControllerDirectory(array(
    'default' => ROOT_APPLICATION_CONTROLLERS,  
));
$frontController->addModuleDirectory(ROOT_APPLICATION.'/modules/');

$layout = Zend_Layout::startMvc(array('layoutPath' => ROOT_APPLICATION_VIEWS_LAYOUTS));
$layout->getView()->addHelperPath(ROOT_APPLICATION_VIEWS . DS. 'helpers');


$frontController->dispatch();