<?php

class ControllerNotFoundException extends PrimitiveException 
{
	
	public function __construct()
  	{
		$msg = '<h1> Controller não encontrado! </h1>';
		$this->message = $msg;
	}
	
}