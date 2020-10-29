<?php

class ActionNotFoundException extends PrimitiveException 
{
	
	public function __construct()
  	{
		$msg = 'Action not found!';
		$this->message = $msg;
	}
	
}