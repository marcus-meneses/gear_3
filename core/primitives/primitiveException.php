<?php

class PrimitiveException extends Exception
{


	
	function __construct() 
	{
		$this->message = "Default PrimitiveException Message";
	}

	public function getMess(){
		return $this->message;
	}


	public function handle()
	{ 
		global $config;
		
		if ( $config['exceptionNotify'] == true ) {

			if ( $config['exceptionNotifyMethod'] == 'silent' ){
				echo "<!-- ". $this->message . " -->";
			}
			else if ( $config['exceptionNotifyMethod'] == 'echo' ){
				echo $this->message;
			}
			else if ( $config['exceptionNotifyMethod'] == 'alert' ){
				echo '<script> alert("' . ( ( $this->message ) ) . '");</script>';
			} 
			else if ($config['exceptionNotifyMethod'] == 'trace'){
				echo $this->message;
				debug_print_backtrace();
			} 
			else {
				echo "<!-- ". $this->message . " -->";
			}
		}	
	}
}