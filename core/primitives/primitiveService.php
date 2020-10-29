<?php

abstract class Service 
{	
	private $name;

	public $App;
	
	function __construct( $serviceName, &$parentApp )
	{
		$this->name = $serviceName;

		$this->App = &$parentApp;


		$this->afterConstruct();
	}

	function __destruct()
	{	
		$this->afterDestruct();
	}

	public static function create( $serviceName, $parentApp ) 
	{
		return new static( $serviceName, $parentApp );
	}

	public function greet()
	{
		echo "Service <b>" . $this->name . "</b> Online <br/>";
	}

	protected function loadService( $serviceName )
	{
		$serviceClassName = ucfirst( $serviceName );
		$fileForInclusion = SERVICES . '' . $serviceName . '.php';
		
		if ( file_exists( $fileForInclusion ) ) {
			include_once( $fileForInclusion );
			$this->{$serviceName.'Service'} = $serviceClassName::create( $this->name . '.' .$serviceName, $this->App );
		}
		else {
			$this->exceptionsService->raise( 'serviceNotFound' );
		}
	}
	
	abstract protected function afterConstruct();

	abstract protected function afterDestruct();
	
}
