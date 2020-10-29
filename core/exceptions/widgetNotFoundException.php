<?php

class WidgetNotFoundException extends PrimitiveException
{

	public function __construct()
	{
		$msg = 'widget not found';
		$this->message = $msg;
	}

}