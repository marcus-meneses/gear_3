<?php

class View  
{	
	private $name;
	public $App;
	public $Data;
	
	private function __construct( $viewName, &$parentApp, $dat )
	{
		$this->name = $viewName;
 		$this->App = &$parentApp;
		$this->Data = $dat;
 

		$this->afterConstruct();
		$this->render();
	}
	
	public function __destruct() 
	{	
		$this->afterDestruct();
	}

	public static function create( $viewName, $appReference, $dat )
	{
		return new static( $viewName, $appReference, $dat  );
	}
	
	public function afterConstruct()
	{
		
	}
	
	public function afterDestruct()
	{
		
	}
	
	public function render()
	{
	
	}


	public function greet()
	{
		echo "View <b>" . $this->name . "</b> Online <br/>";
	}


	public function loadTemplateComponent($templateSection) {

		global $config;

		if ($config['template']!=false) {

			$fileForInclusion = BACKENDTEMPLATES . $templateSection . '.php' ;

			//echo $fileForInclusion;

			if ( file_exists( $fileForInclusion ) )	{
				require( $fileForInclusion );
			} else 	{
				$this->App->exceptionsService->raise( 'templateComponentNotFound' );
			}
		} else 	{
				$this->App->exceptionsService->raise( 'templateComponentInvalid' );
		}


	}

/*
	public function loadCss( $cssname )
	{
		global $config;
		echo '<link rel="stylesheet" type="text/css" href="' . THEMES . '/css/' . $cssname . '.css" />';
	}

	public function loadJs( $jsname )
	{
		global $config;
		echo '<script type="text/javascript" src="' . THEMES . '/js/' . $jsname . '.js"></script>';
	}
	
	public function loadImg( $imgname, $class = null, $style = null )
	{
		global $config;

		$instyle = $style;
		if ( $class == null ) {
			echo '<img src="' . FRONT .$config['template']. '/img/' . $imgname . '" style="'.$instyle.'"/>';
		}
		else {
			echo '<img class="' . $class . '" src="' . FRONT .$config['template']. '/img/' . $imgname . '" style="'.$instyle.'" />';
		}
	}


	public function loadPublicImg( $imgname, $class = null, $style = null )
	{
		 
		$instyle = $style;
		if ( $class == null ) {
			echo '<img src="' . PUBLIC_FILES . $imgname . '" style="'.$instyle.'"/>';
		}
		else {
			echo '<img class="' . $class . '" src="' . PUBLIC_FILES  . $imgname . '" style="'.$instyle.'" />';
		}
	}


	public function publicFile( $imgname )
	{
 
			echo   PUBLIC_FILES . $imgname;
	 
	}


	public function imgFile( $imgname )
	{

		global $config;
 
			echo FRONT .$config['template']. '/img/' . $imgname;
	}



		
	public function loadFont( $fontname )
	{
		global $config;
		echo '<link rel="stylesheet" type="text/css" href="' . FRONT .$config['template']. '/fonts/' . $fontname . '-font.css" />';
	}
 
*/
	
	public function loadWidget( $widgetName )
	{
		 $pieces = explode(".", $widgetName);

			//$fileForInclusion = WIDGETS  . $widgetName . '.wid' ;
			$fileForInclusion =  MODULES . $pieces[0].'/widgets/'.$pieces[1] . '.wid' ;

			//echo $fileForInclusion;

			if ( file_exists( $fileForInclusion ) )	{
				require( $fileForInclusion );
			} else 	{

				$this->App->exceptionsService->raise( 'widgetNotFound' );

			}


	}



}
