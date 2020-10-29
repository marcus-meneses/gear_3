<?php

class ModelNotFoundException extends PrimitiveException 
{
	
	public function __construct()
  	{
		$msg = 'kd model, cralho?';
		$this->message = $msg;
	}
	
}
