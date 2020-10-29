<?php

class Controller 
{
	private $name;
	private $jsCode;

	public $App; 
	public $Data;
	
	private function __construct( $controllerName, &$parentApp, $dat  )
	{
		global $autoload;
		global $config;

	 	
		$this->name = $controllerName;
		$this->App = &$parentApp;
		$this->Data = $dat;
		
		// load default services
		for ( $i = 0; $i < sizeOf( $autoload['services'] ); $i++) {
			$this->loadService( $autoload['services'][$i] );
		}
		
		// load default models
		for ( $i = 0; $i < sizeOf( $autoload['models'] ); $i++) {
			$this->loadModel( $autoload['models'][$i] );
		}
/*
		if ( $config['template']!=false ) {
			
			define( 'TEMPLATE',  	TEMPLATES .$config['template'].'/templates/' );

		}
*/ 		
		$this->afterConstruct();
	}
	
	public function __destruct()
	{
		global $config;
	
		$this->afterDestruct();
	}

	public static function create( $controllerName, $parentApp, $dat ) 
	{
		return new static( $controllerName, $parentApp, $dat  );
	}

	
	public function greet()
	{
		echo "Controller <b>" . $this->name . "</b> Online <br/>";
	}
	
	public function loadView( $viewName  ) 
	{

		$pieces = explode(".", $viewName);

		$viewClassName = ucfirst( $pieces[1] );

		$fileForInclusion =  MODULES . $pieces[0].'/views/'.$pieces[1] . '.php' ;

		 

		if ( file_exists( $fileForInclusion ) ) {
			require_once( $fileForInclusion );
			return $viewClassName::create( $this->name . '.' .$pieces[1], $this->App, $this->Data  );
		}
		else {
			$this->App->exceptionsService->raise( 'viewNotFound' );
		}

	}
	
	public function loadModel( $modelName ) 
	{

		$pieces = explode(".", $modelName);

		$modelClassName = ucfirst( $pieces[1] ).'Model';



		$fileForInclusion = MODULES . $pieces[0].'/models/'.$pieces[1] . '.php';

		////print_r($facadeClassName.'</br>');
		////print_r($facadeName);

		if ( file_exists( $fileForInclusion ) ) {
			include_once( $fileForInclusion );
			$this->{$pieces[1].'Model'} = $modelClassName::_create( $this->name . '.' .$pieces[1].'Model', $this->App, $pieces[1] );
		}
		else {
			$this->App->exceptionsService->raise( 'modelNotFound' );
		}
	}
	
	public function loadService( $serviceName )
	{
		$serviceClassName = ucfirst( $serviceName );
	
		$fileForInclusion = SERVICES . '' . $serviceName . '.php';
		if ( file_exists( $fileForInclusion ) ) {
			include_once( $fileForInclusion );
			$this->{$serviceName.'Service'} = $serviceClassName::create( $this->name.'.'.$serviceName, $this->App );
		}
		else {
			$this->App->exceptionsService->raise( 'serviceNotFound' );
		}
		
	}
	
	public function stackJavaScript( $javaScriptCode ) 
	{
		$this->jsCode = $this->jsCode.$javaScriptCode;
	}
	
	public function dumpJavaScript()
	{
		echo $this->jsCode;
	}

	protected function afterConstruct()
	{
		
	}
	
	protected function afterDestruct()
	{
		
	}	
}
