<?php

class DataAccess extends Service
{

	private $table;
	private $order = 'ASC';
	private $lastInsert;
	private $name;

	protected function afterConstruct()
	{
		$this->loadDatabaseService();
	}


	protected function afterDestruct() 
	{
	 
	}


	public function setDbTable( $table )
	{
		$this->table = $table;
	}
	
	public function getDbTable( $table )
	{
		return $this->table; 
	}
	
	
	
    protected function loadDatabaseService()
	{
    	$serviceName = 'mysql';
      	$serviceClassName = ucfirst( $serviceName );
  
      	$fileForInclusion = SERVICES . '' . $serviceName . '.php';
      	if ( file_exists( $fileForInclusion ) ) 
		{
        	include_once( $fileForInclusion );
        	$this->database = $serviceClassName::create( $this->name . '.' . $serviceName, $this->App );
			
		}
      	else 
		{
        	$this->App->exceptionsService->raise( 'serviceNotFound' );
      	}
    }
	
	public function orderUp()
	{
		$this->order = 'ASC';
	}
	
	public function orderDown()
	{
		$this->order = 'DESC';
	}
	
	public function find( $index = null, $key = null, $value = null, $fields = null )
	{	
		if ( $fields == null ) {
			$fieldstring = "*";
		}
		else {
			$fieldstring = implode( ",", $fields);
		}

		if ($key == null) {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " ORDER BY ".$index." " . $this->order;
		}
		else {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " WHERE `" . $key . "` = '" . $value . "' ORDER BY ".$index." " . $this->order;
		}
		
		/*
		$result = $this->database->query( $sql );
		return $result->fetchAll();
		*/
		return $sql;
	}


	public function between( $index = null, $key = null, $value1 = null, $value2 = null, $fields = null )
	{	
		if ( $fields == null ) {
			$fieldstring = "*";
		}
		else {
			$fieldstring = implode( ",", $fields);
		}

		if ($key == null) {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " ORDER BY ".$index." " . $this->order;
		}
		else {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " WHERE `" . $key . "` >= '" . $value1 . "' AND `" . $key . "` <= '" . $value2 ."' ORDER BY ".$index." " . $this->order;
		}
		
		/*
		$result = $this->database->query( $sql );
		return $result->fetchAll();
		*/
		return $sql;
	}


	public function contains( $index = null, $key = null, $value = null, $fields = null )
	{	
		if ( $fields == null ) {
			$fieldstring = "*";
		}
		else {
			$fieldstring = implode( ",", $fields);
		}

		if ($key == null) {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " ORDER BY ".$index." " . $this->order;
		}
		else {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " WHERE `" . $key . "` LIKE '%" . $value . "%' ORDER BY ".$index." " . $this->order;
		}
		
		/*
		$result = $this->database->query( $sql );
		return $result->fetchAll();
		*/
		return $sql;
	}

	public function starts( $index = null, $key = null, $value = null, $fields = null )
	{	
		if ( $fields == null ) {
			$fieldstring = "*";
		}
		else {
			$fieldstring = implode( ",", $fields);
		}

		if ($key == null) {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " ORDER BY ".$index." " . $this->order;
		}
		else {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " WHERE `" . $key . "` LIKE '" . $value . "%' ORDER BY ".$index." " . $this->order;
		}
		
		/*
		$result = $this->database->query( $sql );
		return $result->fetchAll();
		*/
		return $sql;
	}


	public function ends( $index = null, $key = null, $value = null, $fields = null )
	{	
		if ( $fields == null ) {
			$fieldstring = "*";
		}
		else {
			$fieldstring = implode( ",", $fields);
		}

		if ($key == null) {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " ORDER BY ".$index." " . $this->order;
		}
		else {
			$sql = "SELECT " . $fieldstring . " FROM " . $this->table . " WHERE `" . $key . "` LIKE '%" . $value . "' ORDER BY ".$index." " . $this->order;
		}
		
		/*
		$result = $this->database->query( $sql );
		return $result->fetchAll();
		*/
		return $sql;
	}

	public function insertArr ($datum)
	{
		$i = 0;
		foreach($datum as $key=>$value)
		{
			//$this->dataset[$key] =	$this->{$key};
			$fields[$i] = $key;
			$data[$i] = $value; 
			$i++;
		}

		$fieldstring = "`" . implode( "`,`", $fields ) . "`";
		$datastring = "'" . implode( "','", $data ) . "'";
		$sql = "INSERT INTO " . $this->table . " (" . $fieldstring . ") VALUES (" . $datastring . ")";
		//echo $sql;

		 /*
		$result = $this->database->query( $sql );
		$this->lastInsert =  $this->database->getLastInsert();
	
		return $this->lastInsert;
		 */
		
		 return $sql;

	}

	public function insert( $fields, $data )
	{
		for ( $i = 0; $i < count( $data ); $i++ ) {
			$data[$i] = htmlentities( $data[$i], ENT_QUOTES );
		}
		
		$fieldstring = "`" . implode( "`,`", $fields ) . "`";
		$datastring = "'" . implode( "','", $data ) . "'";
		$sql = "INSERT INTO " . $this->table . " (" . $fieldstring . ") VALUES (" . $datastring . ")";
	
	/*
		$result = $this->database->query( $sql );
		$this->lastInsert =  $this->database->lastInsert;
	
		return $result;
	*/
		return $sql;
	}

	public function lastInsert() 
	{
		return $this->database->lastInsert;
	}

	public function remove( $key, $value )
	{	
		$sql = "DELETE FROM " . $this->table . " WHERE `" . $key . "`='" . $value . "'";
		/*
		$result = $this->database->query( $sql );
		return $result;
		*/
		return $sql;
	}
	
	public function updateArr ($ikey, $ivalue, $datum)
	{
		$i = 0;
		foreach($datum as $key=>$value)
		{
			//$this->dataset[$key] =	$this->{$key};
			if ($key == $ikey) continue;
			$fields[$i] = $key;
			$data[$i] = $value; 
			$i++;
		}

		$setstring = "";	
		
		for ( $i = 0; $i < count( $fields ); $i++ ){
			$setstring = $setstring . "`" . $fields[$i] . "`='" . htmlentities( $data[$i], ENT_QUOTES ) . "'";
			if ( $i < count( $fields ) - 1 ) {
				$setstring = $setstring . ",";
			} 
		}

		$sql =  "UPDATE " . $this->table . " SET " . $setstring . " WHERE `" . $ikey . "` = '" . $ivalue . "'";
		/*
		$result = $this->database->query( $sql );
		return $result;
		*/
		return $sql;

	}

	public function update( $key, $value, $fields, $sdata )
	{
		$setstring = "";	
		
		for ( $i = 0; $i < count( $fields ); $i++ ){
			$setstring = $setstring . "`" . $fields[$i] . "`='" . htmlentities( $sdata[$i], ENT_QUOTES ) . "'";
			if ( $i < count( $fields ) - 1 ) {
				$setstring = $setstring . ",";
			} 
		}
		
		$sql =  "UPDATE " . $this->table . " SET " . $setstring . " WHERE `" . $key . "` = '" . $value . "'";
		/*
		$result = $this->database->query( $sql );
		return $result;
		*/
		return $sql;
	}

}
