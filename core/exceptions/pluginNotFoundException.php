<?php

class PluginNotFoundException extends PrimitiveException 
{
	
	public function __construct()
	{
		$msg = 'plugin not found';
		$this->message = $msg;
	}
		
}