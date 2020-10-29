<?php

class Log extends Service
{

 

	protected function afterConstruct()
	{
		$this->loadService('files');
	}


	protected function afterDestruct() 
	{
	 
	}

	 
	public function greet()
	{
		echo "Log service <b>" . $this->name . "</b> Online <br/>";
	}


    public function logData($data)
    {
        global $config;
 
        if ($config['logMode']=='single') {
            //single log. add to the heap;
            $this->filesService->KR_log('gear.log', $data );
        } else  if ($config['logMode']=='daily') {
            //open today's file and print to it;
        }

    }
	
    
}