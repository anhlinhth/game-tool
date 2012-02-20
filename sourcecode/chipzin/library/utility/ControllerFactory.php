<?php
class ControllerFactory
{
	public static function getController($controllerName, $request, $response)
	{
		require_once ROOT_APPLICATION_CONTROLLERS.DS.$controllerName.".php";
		
		$refClass = new ReflectionClass($controllerName);		
		$controller = $refClass->newInstanceArgs(array($request,$response));
		
		return $controller;
	}
}
?>
