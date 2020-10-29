<?php

class Sessions extends Service 
{


	protected function afterDestruct()
	{

	}	

	protected function afterConstruct() 
	{
        global $config;

             $this->start();
         
    }

    private function start() 
	{
 
		if (session_status() == PHP_SESSION_NONE) {
    		session_start();
		}
    }
    
    public function clear() 
	{
    	session_unset();
    	return true;
    }
    
    public function end() 
	{
    	session_destroy(); 
    	return true;
    }

    public function set( $key, $value ) 
	{
   	 	if ( $key != '' ) { 
   	 		$_SESSION[$key] = $value;
    		return true;
    	}

    	return false;
    }

	public function push ($sessar, $val)
	{
		if ( !isset( $_SESSION[$sessar] ) ) {
			$_SESSION[$sessar]=[];
		}	

		$_SESSION[$sessar][] = $val;
	}


	public function pop ($sessar, $index)
	{
		if ( !isset( $_SESSION[$sessar] ) ) {
			return false;
		}	

		if (count($_SESSION[$sessar])>1) {
		
		if ($sessar>0) {
			array_splice($_SESSION[$sessar], 1, $index);
		} else 
		{
			array_shift($_SESSION[$sessar]);
		}


		} else {
		$this->remove( $sessar );
		}
		 
	}



    public function get ( $key )  
	{

        if ( isset( $_SESSION[$key] ) ) {
			return $_SESSION[$key];
		}	
		
		return false;
    }
    
    public function remove( $key ) 
	{
    	if ( $key != '' ) {
			unset( $_SESSION[$key] );
		}
    }
    
    public function dump() 
	{
    	//print_r( $_SESSION );
    }
        
    public function id()
	{
		if ( session_id() != '') {
			return session_id();
		}
		
		return false;
    }

}