<?php


class Mysql extends Service 
{
	private $databaseConnection;
	private $resultSet;
	private $lastInsert;
	private $databaseCredentials;

	protected function afterConstruct() 
	{
		global $databaseConfig;

		$this->databaseCredentials['host'] 		=  $databaseConfig['host'];
		$this->databaseCredentials['port'] 		=  $databaseConfig['port'];
		$this->databaseCredentials['username']  =  $databaseConfig['username'];
		$this->databaseCredentials['password']  =  $databaseConfig['password'];
		$this->databaseCredentials['database']  =  $databaseConfig['database'];
		$this->connect();
	}

	public function connect()
	{

		
    	$this->databaseConnection = new PDO("mysql:host=" . 
			$this->databaseCredentials['host'] . ";dbname=" . 
			$this->databaseCredentials['database'],
			$this->databaseCredentials['username'],
			$this->databaseCredentials['password']
		);
		$this->databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function disconnect()
	{
		$this->databaseConnection = null;
	}

	public function reconnect()
	{
		$this->disconnect();
		$this->connect();
	}

    public function query( $sql ) 
	{
 
       $this->resultSet = $this->databaseConnection->query( $sql );   
       $this->lastInsert = $this->databaseConnection->lastInsertId();

	   //log query execution & query result digest (if error as well)

       return $this->resultSet;
    }

	public function setDatabaseHost( $host )
	{
		$this->databaseCredentials['host'] = $host;
	}

	public function getDatabaseHost()
	{
		return $this->databaseCredentials['host'];
	}

	public function setDatabasePort( $port )
	{
		$this->databaseCredentials['port']=$port;
	}

	public function getDatabasePort()
	{
		return $this->databaseCredentials['port'];
	}

	public function setDatabaseUsername( $username )
	{
		$this->databaseCredentials['username'] = $username;
	}

	public function getDatabaseUsername()
	{
		return $this->databaseCredentials['username'];		
	}

	public function setDatabasePassword( $password )
	{
		$this->databaseCredentials['password'] = $password;
	}

	public function getDatabasePassword()
	{
		return $this->databaseCredentials['password'];
	}

	public function setDatabaseDatabase( $database )
	{
		$this->databaseCredentials['database'] = $database;
	}

	public function getDatabaseDatabase()
	{
		return $this->databaseCredentials['database'];		
	}

	public function getLastInsert()
	{
		return $this->lastInsert;		
	}
	protected function afterDestruct()
	{
		$this->disconnect();
	}
}