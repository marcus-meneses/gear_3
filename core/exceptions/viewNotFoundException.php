<?php

class ViewNotFoundException extends PrimitiveException
{

	public function __construct()
	{
		$msg = 'view not found';
		$this->message = $msg;
	}

}