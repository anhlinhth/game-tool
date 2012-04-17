<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';

require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';

require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'models'.DS.'Models_Map_Package.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'models'.DS.'Models_Battle_Package.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'Campaign'.DS.'models'.DS.'Models_Map_Battle_Package.php';
class Campaign_ExportCampController extends BaseController
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
	public function exportAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNorender();
		try{
		$model = new Models_Map_Package();
		
		$tuo = new Models_Map_Package();
		$data = $tuo->getdata();
		
		$model->generate($data);
		$mdB = new Models_Battle_Package();
		$data = $mdB->fetchall();
		$mdB->generate($data);
		
		$mdmB = new Models_Map_Battle_Package();
		$data = $tuo->getdata();
		$mdmB->generate($data);
		echo "<script>";echo "if(confirm('th�nh c�ng'))window.location=\"index\""; echo "</script>";
		//$this->_redirect ("campaign/exportcamp/index");
		}
		catch (Exception $e)
		{
			echo $e;
		}
		
	}
	public function downloadAction()
	{
	}
	public function indexAction()
	{
	}
	

}

