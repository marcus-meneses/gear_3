<?php

class EntityNotFoundException extends PrimitiveException
{
	public function __construct()
	{
		$msg = 'entity not found';
		$this->message = $msg;
	}

}