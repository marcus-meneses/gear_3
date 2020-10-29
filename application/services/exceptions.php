<?php

class Exceptions extends Service 
{
	public function raise ( $exceptionName ) 
	{

		global $config;

		try {
			$exceptionName = $exceptionName.'Exception';
			$exceptionClassName = ucfirst( $exceptionName );
			require_once( EXCEPTIONS . '' . $exceptionName . '.php' );

			//log exceptions here



		    if ( $config['logActive'] == true) 	$this->App->logService->logData('Exception |'.$exceptionName.'| raised by the system.');

			throw new $exceptionClassName();
		}catch( Exception $err) {
			$err->handle();

			////print_r($err);

			if ( $config['logActive'] == true) 	$this->App->logService->logData('Exception |'.$err->getMess().'| successfully caugth.');

		}	
		
	}


	protected function afterDestruct()
	{
		 
	}

	protected function afterConstruct()
	{
		 
	}

}