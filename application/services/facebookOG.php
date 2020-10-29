<?php

class FacebookOG extends Service 
{

 public $OGProperties=[];

	protected function afterDestruct()
	{

	}	

	protected function afterConstruct() 
	{
         
    }


/*
<meta property="og:url"   content="http://voastudio.tech/" />
<meta property="og:image" content="http://voastudio.tech/img/fbimg/fbthumb.png"/>
<meta property="og:title" content="VOA Studio"/>
<meta property="og:description" content="Websites, E-commerce, Apps, Softwares Desktop, Hardware. VOA é o SEU estúdio de tecnologia." />
<meta property="og:site_name" content="VOA Studio"/>
<meta property="og:type" content="website"/>
*/

    public function url ($url) {
        $this->OGProperties['og:url'] = $url;
    }

    public function image ($uri) {
         $this->OGProperties['og:image'] = $uri;
    }

    public function title ($title) {
         $this->OGProperties['og:title'] = $title;
    }

    public function description ($description) {
         $this->OGProperties['og:description'] = $description;     
    }

    public function siteName ($sitename) {
         $this->OGProperties['og:site_name'] = $sitename;
    }

    public function type($type) {
        $this->OGProperties['og:type'] = $type;
    }

    public function feed(&$variable) {

        $summer = '<!-- FACEBOOK OG SERVICE -->';
        foreach ($this->OGProperties as $key=>$value) {
           $summer = $summer.'<meta property="'.$key.'"   content="'.$value.'" />';
        }

        $summer = $summer . '<!-- OG SERVICE END -->';

         $variable=$summer;
    }

        

}