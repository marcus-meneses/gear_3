<?php


class TemplateComponentNotFoundException extends PrimitiveException
{

	public function __construct()
	{
		$msg = 'template component not found';
		$this->message = $msg;
	}
	
}