<?php

class Index extends View
{

 public function render()
 {

 $this->loadTemplateComponent('header');
 $this->loadWidget('docs.index');
 $this->loadTemplateComponent('footer');

 }


}
