<?php

class Index extends View 
{
	public function render()
	{
	 
	$this->loadTemplateComponent('header');
	$this->loadWidget('home.index');
	$this->loadTemplateComponent('footer');

	
	}
}
