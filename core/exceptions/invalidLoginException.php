<?php

class InvalidLoginException extends PrimitiveException
{

	public function __construct()
	{
		$msg = 'Login attempt unsuccessful';
		$this->message = $msg;
	}
	
}