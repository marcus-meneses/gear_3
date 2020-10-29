<?php

class Docs extends Controller
{

 public function index( array $data = null )
 {

 $indexView = $this->loadView('docs.index', $data);

 }


}
