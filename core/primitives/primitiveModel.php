<?php
 


//write transparent ORM code

class Model 
{
	private $_name;
	private $App;
	private $dataset=['empty'];
	
	private function __construct( $modelName , &$parentApp, $table )
	{
		$this->_name = $modelName;
		$this->App = &$parentApp;
		 
		$this->loadService( 'dataAccess' );
		$this->dataAccessService->setDbTable($table);
		$this->afterConstruct();
	}
	
	public static function _create( $modelName, $parentApp, $tabl ) 
	{
		return new static( $modelName, $parentApp, $tabl );
	}
	
	public function __destruct()
	{	
	
		$this->afterDestruct();
	}
	
	public function afterConstruct()
	{
		$this->getSVars();
	}

	public function afterDestruct()
	{
		
	}
	

	public function greet()
	{
		echo "Model <b>" . $this->name . "</b> Online <br/>";
	}
	
        protected function loadService( $serviceName )
	{
		$serviceClassName = ucfirst( $serviceName );
		$fileForInclusion = SERVICES . '' . $serviceName . '.php';
		
		if ( file_exists( $fileForInclusion ) ) {
			include_once( $fileForInclusion );
			$this->{$serviceName.'Service'} = $serviceClassName::create( $this->_name . '.' .$serviceName, $this->App );
		}
		else {
			$this->exceptionsService->raise( 'serviceNotFound' );
		}
	}

	public function setTable( $tableName )
	{
		$this->dataAccessService->setDbTable($tableName);
	}


	public function getSVars() 
	{
		$result = array();
		foreach (get_object_vars($this) as $name => $default)
		{
			if (!isset($this->{$name})) $result[$name] = $default;
		}
		$this->dataset = $result;
	}

	public function updateSVars()
	{
		foreach($this->dataset as $key=>$value)
		{
			$this->dataset[$key] =	$this->{$key};
			 
		}
	}

	public function getVars()
	{
		//return  get_class_vars(get_class($this));
		return get_object_vars($this);
	}

	public function create()
	{
		$this->updateSVars();
		return $this->dataAccessService->insertArr($this->dataset);
		//var_dump($this->dataset);
	}


	public function retrieve_exact( $keyName )
	{
		$this->updateSVars();
		$keys = array_keys(  $this->dataset ); 
		return $this->dataAccessService->find(  $keys[0] , $keyName, $this->dataset[$keyName] );

	}

	public function retrieve_between( $keyName, $secondValue )
	{
		$this->updateSVars();
		$keys = array_keys(  $this->dataset ); 
		return $this->dataAccessService->between(  $keys[0] , $keyName, $this->dataset[$keyName], $secondValue );

	}

	public function retrieve_contains( $keyName )
	{
		$this->updateSVars();
		$keys = array_keys(  $this->dataset ); 
		return $this->dataAccessService->contains(  $keys[0] , $keyName, $this->dataset[$keyName] );

	}

	public function retrieve_starts( $keyName )
	{
		$this->updateSVars();
		$keys = array_keys(  $this->dataset ); 
		return $this->dataAccessService->starts(  $keys[0] , $keyName, $this->dataset[$keyName] );

	}

	public function retrieve_ends( $keyName )
	{
		$this->updateSVars();
		$keys = array_keys(  $this->dataset ); 
		return $this->dataAccessService->ends(  $keys[0] , $keyName, $this->dataset[$keyName] );

	}


	public function update($keyName)
	{
		$this->updateSVars(); 
		return $this->dataAccessService->updateArr($keyName, $this->dataset[$keyName], $this->dataset);
	}

	public function delete($keyName)
	{
		$this->updateSVars();

		return $this->dataAccessService->remove($keyName, $this->dataset[$keyName]);
	}

	
}
