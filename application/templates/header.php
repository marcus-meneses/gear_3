<html>
<head> 



  
<?php
  if (isset($this->Data['facebookOG'])) {
    echo $this->Data['facebookOG'];
    unset($this->Data['facebookOG']);
  }
?>

<meta charset="UTF-8">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-control" content="public">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

<meta name="apple-mobile-web-app-capable" content="yes">

<meta name="mobile-web-app-capable" content="yes">

<title><?php echo $config['appname'];?></title>



<link rel="stylesheet" href="<?php echo $this->App->theme_url('fonts/opensans.css')?>" type="text/css">


<script defer src="<?php echo $this->App->theme_url('fontawesome/js/all.js');?>"> </script>
<link rel="stylesheet" href="<?php echo $this->App->theme_url('plugins/bootstrap/css/bootstrap.min.css');?>">     
<link rel="stylesheet" href="<?php echo $this->App->theme_url('plugins/prism/prism.css');?>">
<link rel="stylesheet" href="<?php echo $this->App->theme_url('plugins/elegant_font/css/style.css');?>"> 
<link id="theme-style" rel="stylesheet" href="<?php echo $this->App->theme_url('css/styles.css');?>">

<!--[if lt IE 9]><script src=https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js></script><script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script><![endif]-->
</head>
<body class="body-orange">
 
 
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
 
       

