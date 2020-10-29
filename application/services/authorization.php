<?php

class Authorization extends Service
{

	function __construct()
	{
		$this->afterConstruct();
	}
	
	protected function afterConstruct() 
	{
		$this->loadService( 'sessions' );
	}


	protected function afterDestruct() 
	{
	 
	}


    public function setUserCredentials( $userid, $class ) 
	{
        $this->sessionsService->set( 'session_user', $userid );
        $this->sessionsService->set( 'session_class', $class );
    }

    public function unsetUserCredentials() 
	{
        $this->sessionsService->remove( 'session_user' );
        $this->sessionsService->remove( 'session_class' );
    }

    public function getUserClass()
	{
        return $this->sessionsService->get( 'session_class' );
    }

	public function getSessionID()
	{
        return $this->sessionsService->id();
    }

    public function getUserId()
	{
        return $this->sessionsService->get( 'session_user' );
    }

    public function isUserAuthenticated()
	{
        return isset( $_SESSION['session_class'] ); 
    }

    public function isUserAuthorized( $controller, $action )
	{
    	global $authorization;

     	$userClass = $this->getUserClass();

		if ( isset( $authorization['any'][$controller][$action] ) ) return true;

		if($userClass==false) return false;

		if ( isset( $authorization[$userClass][$controller][$action] ) ) return true;
	
		return false;   	
    }
}