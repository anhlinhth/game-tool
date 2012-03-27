<?php
require_once ROOT_APPLICATION_CONTROLLERS . DS . 'BaseController.php';
// require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'models' .
//     DS . 'Models_Campaign.php';
// require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'models' .
//     DS . 'Models_WorldMap.php';
// require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'form' .
//     DS . 'Forms_Campaign.php';
// require_once ROOT_APPLICATION . DS . 'modules' . DS . 'Campaign' . DS . 'object' .
//     DS . 'Obj_Base.php';
require_once ROOT_LIBRARY_UTILITY . DS . 'utility.php';
require_once ROOT_APPLICATION_MODELS . DS . 'Models_Log.php';
class Campaign_OtherController extends BaseController
{
    public function _setUserPrivileges()
    {
        return array('index');
    }

    public function preDispatch()
    {
        parent::preDispatch();

        if (!$this->hasPrivilege())
            $this->_redirect("/error/permission");
    }
    ///////////////////////
    public function indexAction()
    {
        try {

            
        }
        catch (exception $ex) {
            $this->view->errMsg = $ex->getMessage();
            Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
        }
    }
    /**************************************/
}
