<?php

class Forms extends Service 
{

	public function receiveFile($fieldname, $public_dir)
	{
		if ( $_FILES[$fieldname]['error'] == '0') {
			$hasfile=true;
			$tmp_name = $_FILES[$fieldname]["tmp_name"];
			$name = time().basename($_FILES[$fieldname]["name"]);
			$final_name = FILES.$public_dir.'/'.$name; 
			$location = PUBLIC_FILES.$public_dir.'/'.$name;

			copy ( $tmp_name , $final_name );
			return $location;
		 
		} else 
		{
			////print_r($_FILES ); die();
			return false;
		}
 	 
	 }
	 
	 
	 public function sanitizeData($data)
	 {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;	 
	 }
 

 	protected function afterConstruct()
	{
	 
	}


	protected function afterDestruct() 
	{
	 
	}

 

}
