<?php
class Base_Bootstrap extends Zend_Application_Module_Bootstrap {
	
	protected function _initView() {
		$view = new Zend_View ();
		/** Set view encoding to UTF-8 */
		$view->setEncoding ( 'UTF-8' );
		$view->doctype ( 'XHTML1_STRICT' );
	}
	
	protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Base_',
            'basePath'  => dirname(__FILE__),
			'resourceTypes' => array(
                          'objects'=>array('path'=>'objects/', 'namespace'=>'Object'),  
						  'controllesr'=>array('path'=>'controllesr/', 'namespace'=>'Controllesr'),	
		)
        ));
        return $autoloader;
    }
}
