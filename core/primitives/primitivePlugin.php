<?php

class Plugin 
{
	private $name;

	private function __construct( $pluginName )
	{
		$this->name = $pluginName;	
		$this->afterConstruct();
	}
	
	public static function create( $pluginName ) {
		return new static( $pluginName );
	}
	
	public function __destruct()
	{
		$this->afterDestruct();
	}
	
	public function afterConstruct()
	{
		
	}
	
	public function afterDestruct()
	{
		
	}
	
	public function greet()
	{
		echo "Plugin <b>" . $this->name . "</b> Online <br/>";
	}
	
	public function run( array $action, array $params )
	{
	
	}
	
}