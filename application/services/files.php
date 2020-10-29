<?php

class Files extends Service
{


	protected function afterConstruct()
	{
		 
	}


	protected function afterDestruct() 
	{
	 
	}

    public function append( $file, $data ) 
	{
    	file_put_contents( FILES . $file, $data . "\n", FILE_APPEND ); 	
    }


    public function KR_log( $file, $data ) 
	{
		//echo LOGS . $file;die();
    	file_put_contents( LOGS . $file, $data . "\n", FILE_APPEND ); 	
    }


    public function write( $file, $data ) 
	{
		$handle = fopen( FILES . $file, "w");
		fwrite( $handle, $data );
		fclose( $handle );
    }

    public function read( $file, $data ) 
	{
     	$returnee = file_get_contents( FILES . $file );	
     	return $returnee;
    }

    public function readJSON( $file, $data ) 
	{
    	$readed = $this->read( FILES . $file, $data );
    	$obj = json_decode( $readed );
    	return $obj;
    }

    public function writeJSON( $file, $_object ) 
	{
    	$textual = json_encode( $_object );
    	$this->write( FILES . $file, $textual );
    }

    public function appendJSON( $file, $_object ) 
	{
    	$textual = json_encode( $_object );
    	$this->append( FILES . $file, $textual );
    }

    public function imgToBase64( $file ) 
	{
		$path = FILES . $file;
		$type = pathinfo( $path, PATHINFO_EXTENSION );
		$data = file_get_contents( $path );
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode( $data );
		return $base64;
    }

    public function base64ToImg( $file, $data ) 
	{
		$splitted = explode( ',', substr( $data , 5 ) , 2 );
		
		$mime = $splitted[0];
		$image = $splitted[1];
		
		$mime_split_partial = explode( ';', $mime, 2 );
		$mime_split = explode( '/', $mime_split_partial[0], 2 );

		if(count( $mime_split )== 2 ){
			$extention = $mime_split[1];
			$output_file = $file .'.' . $extension;
		}
		
		file_put_contents( FILES . $file . '.' . $extention, base64_decode( $image ) );
		return ( $file . '.' . $extention );
	}
	
}