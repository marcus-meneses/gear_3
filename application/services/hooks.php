<?php

class Hooks extends Service 
{

    private $methodPile = array();

	protected function afterDestruct()
	{

	}	

	protected function afterConstruct() 
	{
         
    }


    public function addHook ($method, $hook) 
    {
        if ( !isset($this->methodPile[$hook] ) ) {
            $this->methodPile[$hook]= array();
        } else {

        }

        $key = array_search($method, $this->methodPile[$hook]);
        if ($key !== false) {
            $this->App->exceptionsService->raise( 'duplicateHook' );
            return false;
        }

        $items[0]=$method;
        array_push($this->methodPile[$hook],$items[0]);
       // print_r($this->methodPile);
        return true;
    }

    public function removeHook ($method, $hook) 
    {
        if ( isset($this->methodPile[$hook] ) ) { 
            $key = array_search($method, $this->methodPile[$hook]);
                if ($key !== false) {
                    unset($this->methodPile[$hook][$key]);
                    return true;
                }
            return false;
         } else {
            return false;
        }
    }
  
    public function trigger($hook)
    {
        if ( !isset($this->methodPile[$hook] ) ) {
            //$this->methodPile[$hook]= array();
            //echo 'EMPTY HOOK!';
        } else {
            for ($i=0; $i< sizeof($this->methodPile[$hook]);$i++){
                $callHook = $this->methodPile[$hook][$i];
                //echo $callHook;
                call_user_func($callHook);
            }
        }
    }
        

}