<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
	protected function _initDb() {
		$dbCfg = new Zend_Config_Ini( ROOT_APPLICATION . DS . 'configs'. DS . 'application.ini', 'db');
		Zend_Registry::set('config', $dbCfg);
		$db = Zend_Db::factory($dbCfg->db);
		$db->query("SET NAMES 'utf8'");
		Zend_Registry::set('db', $db);
		return $db; 		
	}
	
	 protected function _initAutoload()
    {
        // $autoloader = new Zend_Application_Module_Autoloader(array(
            // 'namespace' => '',
            // 'basePath'  => dirname(__FILE__),
			// 'resourceTypes' => array(
                          // 'controllers'=>array('path'=>'controler/', 'namespace'=>'Object'),
						  // 'objects'=>array('path'=>'models/', 'namespace'=>'Model'),           
		// )
        // ));
        // return $autoloader;
    }
	
	/**
	 * Init session
	 * 
	 * @return void
	 */
	protected function _initSession() {
		
	}
	
	/**
	 * Register plugins
	 * 
	 * @return void
	 */
	protected function _initPlugins() {
	
	
	}
 	
	protected function _initLoadRouter(){
		
	}

}