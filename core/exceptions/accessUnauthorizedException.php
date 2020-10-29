<?php

class AccessUnauthorizedException extends PrimitiveException
{
	public function __construct()
	{
		$msg = 'Access unauthorized.';
		$this->message = $msg;
	}


}