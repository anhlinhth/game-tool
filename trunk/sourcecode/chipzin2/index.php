<?php
/**
 * Check PHP version
 */
if (version_compare(phpversion(), '5.2.0', '<') === true) {
    die('ERROR: Your PHP version is ' . phpversion() . '. Honey CMS requires PHP 5.2.0 or newer.');
}
require_once ('define.php');

set_include_path('.'. PATH_SEPARATOR . get_include_path() . PATH_SEPARATOR . ROOT.'/library/');

 /*
 * Run the application
 * Use Zend_Application
 */
require_once 'Zend/Application.php';
$environment = "development";
$application = new Zend_Application(
    $environment,
    ROOT_APPLICATION . DS . 'configs'. DS . 'application.ini'
);


/**
 * Don't store following options to application.ini, because when user try to install,
 * the installer can not save these options to application.ini
 * (it replaces ROOT_APPLICATION with real path)
 */
$options = array(
	'bootstrap' => array(
    	'path' 	=> ROOT_APPLICATION . DS . 'Bootstrap.php',
		'class' => 'Bootstrap',
    ),
    'autoloadernamespaces' => array(
		'base' => 'Base_',
    ),
	'resources' => array(
		'frontController' => array(
			'moduleDirectory'				=> ROOT_APPLICATION . DS . 'modules',
			'moduleControllerDirectoryName'	=> 'controllers',    		
    		'defaultModule'		  			=> 'base', //default Module    		
    		'params'	=> array(
    			'displayExceptions'	=> 1, 		// throwExceptions 
    		),  		
		),
		'layout' => array(			
			'layoutPath'	=> ROOT_APPLICATION . DS . 'templates'. DS . 'default',
			'layout'		=> 'layout'
		),
		'view' => array(
			'helperPath' => array(
				'Zend_View_Helper'	=> ROOT_APPLICATION . DS . 'modules'.DS.'base'.DS.'views'.DS.'helpers',
				//'Block'				=> ROOT_APPLICATION . DS . 'blocks',
			),
		),
		'modules' => array(
		),
	),
);
$options = $application->mergeOptions($application->getOptions(), $options);
$application->setOptions($options)
			->bootstrap()
			->run();