<?php
class Gss_Exception extends Exception
{
	public function __construct($mess=null,$code=0)
	{
		
		parent::__construct($mess,$code);
	}
}