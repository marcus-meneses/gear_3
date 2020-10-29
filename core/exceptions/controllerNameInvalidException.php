<?php

class ControllerNameInvalidException extends PrimitiveException 
{
	
	public function __construct()
  	{
		$msg = 'controller name invalid';
		$this->message = $msg;
	}
	
}