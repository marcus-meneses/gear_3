<?php

class ActionNameInvalidException extends PrimitiveException 
{	
	public function __construct()
	{
		$msg = 'Action name invalid';
		$this->message = $msg;
	}
		
}