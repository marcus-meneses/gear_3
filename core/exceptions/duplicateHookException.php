<?php

class DuplicateHookException extends PrimitiveException
{

	public function __construct()
	{
		$msg = 'Method already hooked to trigger';
		$this->message = $msg;
	}
	
}