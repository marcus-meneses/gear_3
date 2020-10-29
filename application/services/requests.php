<?php

class Requests extends Service 
{
	private $url='';
	private $method='GET';
	private $params = [];
	private $returns = '';
	private $name;
	private $headers=[];

    public function url ($url = null) 
	{
		if ($url == null){
			return $this->url;
		} else {
			$this->url=$url;
			return true;
		}
    }
      
    public function method ($mth = null) 
	{
		if ($mth == null){
			return $this->$method;
		} else {
			$this->method = $mth;
			return true;
		}
    }
    
    public function parameters ($para = null) 
	{
		if ($para == null){
			return $this->params;
		} else {
			$this->params=$para;
			return true;
		}
    }

    public function setParameter( $key, $value )
	{
		unset($this->params[$key]);
		$this->params[$key] = $value;
    }

    public function unsetParameter( $key )
	{
		unset( $this->params[$key]);
    }

    public function setHeader( $header, $value )
	{
		unset($this->headers[$header]);
		$this->headers[$header] = $value;
    }

    public function unsetHeader( $header )
	{
		unset($this->headers[$header]);
    }

    public function buildHeaders()
	{
		$i=0; 

		$tempar=[];

		foreach ( $this->headers as $key => $value ) {
			$tempar[$i] = $key . ": " . $value;
			$i++;
		}

		return $tempar;
    }
    
    
    public function headers()
	{
      return $this->headers;
    }

    public function response () 
	{
  		return $this->$returns;
    }
    
    public function exec() 
	{
    	if ( $this->method == "GET" ) {
			$ch = curl_init();

			if ( $this->params!=[] ) {
				//echo http_build_query( $this->params  );
				//die();
				curl_setopt( $ch, CURLOPT_URL, $this->url . '?' . http_build_query( $this->params  ) );
 
			} else {
				curl_setopt( $ch, CURLOPT_URL, $this->url ); 

			}

			curl_setopt($ch,CURLOPT_USERPWD,":");
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $this->buildHeaders());
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			$content = trim( curl_exec( $ch ) );
			curl_close( $ch );
			$this->returns = $content;
			return $content;  
			
    	} else if ( $this->method == "POST" ) {

			////print_r($this->params);
			////print_r($this->headers);
			////print_r($this->url); die();

			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $this->url );
			curl_setopt( $ch, CURLOPT_POST, 1 );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $this->params ) );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $this->buildHeaders() );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

			$returnee = curl_exec ( $ch );
			curl_close ( $ch );    	  	
			$this->returns= $returnee;
			return $returnee;    	
    	} else {
    		$this->returns='';
    		return false;
    	}   
    }



	protected function afterConstruct() 
	{
		 
	}
 
 	protected function afterDestruct()
	{
	 
	}

}