<?php

class Home extends Controller  
{

	public function index( array $data = null ) 
    {

		$indexView = $this->loadView('home.index');

	}

	public function authorized_only( array $data = null ) 
    {

		$indexView = $this->loadView('home.authorized');

	}


 

}
