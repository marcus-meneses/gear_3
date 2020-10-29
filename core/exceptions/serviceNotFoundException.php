<?php


class ServiceNotFoundException extends PrimitiveException 
{

	private $msg = 'service not found';

	public function __construct()
	{
		$this->message = $this->msg;
	}

}