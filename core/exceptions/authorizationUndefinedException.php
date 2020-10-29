<?php

class AuthorizationUndefinedException extends PrimitiveException
{
	public function __construct()
	{
		$msg = 'Authorization Undefined.';
		$this->message = $msg;
	}


}