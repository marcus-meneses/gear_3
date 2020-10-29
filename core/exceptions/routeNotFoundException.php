<?php

class RouteNotFoundException extends PrimitiveException 
{
	
	public function __construct()
	{
		$msg = 'Caminho inexistente. Contact o WebMaster.';
		$this->message = $msg;
	}	

}