<?php 

$config['appname']='MARCUS 1';
$config['template']='pretty';

//cryptography config
$config['cryptokey']='EMJEBZCGME647NY4ATOAZXRKD957KXF0HK2LKHIWBIYMU2SJCJ7TSPKS3NH1ARUY';

//visual debug config
$config['visual_debug']=false; 

//benchmark config
$config['benchmarkMethod']='silent';

//authorization & authentication config
$config['authorization']=true;
$config['authorizationHandle']='exception';
$config['defaultRoute']='home/index';

//exceptions config
$config['exceptionNotify']=true;
$config['exceptionNotifyMethod']='trace';


//logs config
$config['logActive']=false;
$config['logMode']='single';  //single, daily, none


//database config
$databaseConfig['broker']='MYSQL';
$databaseConfig['host']='localhost';
$databaseConfig['port']='3306';
$databaseConfig['username']='root';
$databaseConfig['password']='root';
$databaseConfig['database']='gear_dev';
