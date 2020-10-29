<?php

class Authentication extends Service
{


	protected function afterConstruct() 
	{
		$this->loadService( 'authorization' );
        $this->loadService( 'dataAccess' );
        $this->loadService( 'forms' );
	}

	protected function afterDestruct() 
	{
	 
	}


    public function authenticate($login, $password)
    {

        //this authentication mechanism does not deal with
        //hashed passwords. If your application demans that
        //user passwords are stored safely, you must provide
        //another version of this method in order to do so

        $login = $this->formsService->sanitizeData($login);
        $password = $this->formsService->sanitizeData($password);

        $this->dataAccessService->setDbTable('users');
        $user = $this->dataAccessService->find('login', $login);

        if(($login=='') || ($password=='')) return 0;

        if ($user[0]['password'] == $password) {
            $this->authorizationService->setUserCredentials( $user[0]['id'],  $user[0]['class'] );
            return 1;
        } else {
            return 0;
        }
    }


    public function logout()
    {
        $this->authorizationService->unsetUserCredentials(); 
    }

}