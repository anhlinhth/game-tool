<?php
class Forms_Base
{
	public $obj;	

	public function _requestToForm($controller)
	{
		$request = $controller->getRequest();
		$arrKey = array_keys((array)$this->obj);
		foreach($arrKey as $key)
		{
			$this->obj->$key = trim($request->getParam($key));
		}	
		return $this->obj;
	}
}