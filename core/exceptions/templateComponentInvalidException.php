<?php


class TemplateComponentInvalidException extends PrimitiveException
{

	public function __construct()
	{
		$msg = 'view not found';
		$this->message = $msg;
	}
	
}