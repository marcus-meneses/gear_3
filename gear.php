<?php

define( 'HTTP_SERVER', 	 ( !empty( $_SERVER['HTTPS'] )? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'RELATIVE_PATH', preg_replace( '/^' . preg_quote( $_SERVER['DOCUMENT_ROOT'], '/' ) . '/', '', __DIR__ ) . '/' );
define( 'ABSOLUTE_PATH', dirname( __FILE__ ) . '/' );
define( 'HTTP_ADDRESS', 		(!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . RELATIVE_PATH );

define( 'CORE', 	 	ABSOLUTE_PATH . 'core/' );
define( 'INCLUDES', 	CORE . 'includes/' );
define( 'EXCEPTIONS', 	CORE . 'exceptions/' );
define( 'LOGS', 	 	CORE . 'logs/' );
define( 'PLUGINS', 	 	CORE . 'plugins/' );
define( 'PRIMITIVES', 	CORE . 'primitives/' );


define( 'APPLICATION', 	ABSOLUTE_PATH . 'application/' );
define( 'SERVICES', 	APPLICATION . 'services/' );
define( 'MODULES', 	 	APPLICATION . 'modules/' );
define( 'CONFIG', 	 	APPLICATION . 'config/' );

define( 'PUB', 	 		ABSOLUTE_PATH . 'public/' );
define( 'FILES', 	 	PUB . 'files/' );
define( 'TEMP', 	 	FILES . 'temp/' );
define( 'STAT', 	 	PUB . 'static/' );
//define( 'FRONT', 	 	ABSOLUTE_PATH . 'front/' );
define( 'PUBLIC_FILES',  	PUB . 'files/' );
define( 'ERRORS', 	 	STAT . 'error/' );



require_once( CONFIG . 'config.php' );
require_once( CONFIG . 'autoload.php' );
require_once( CONFIG . 'routes.php' );
 

//define( 'TEMPLATES', 	HTTP_ADDRESS.'public/themes/' . $config['template']. '/templates/' );
define( 'THEMES', 	HTTP_ADDRESS.'public/themes/' . $config['template']. '/' );
define( 'BACKENDTEMPLATES', 	ABSOLUTE_PATH.'application/templates/' );
define( 'BACKENDTHEMES', 	ABSOLUTE_PATH.'public/themes/' . $config['template']. '/' );

require_once( PRIMITIVES . 'primitiveException.php' );
require_once( PRIMITIVES . 'primitiveView.php' );
//require_once( PRIMITIVES . 'primitiveDao.php' ); // will this ever be used?
//require_once( PRIMITIVES . 'primitiveEntity.php' );
require_once( PRIMITIVES . 'primitiveModel.php' );
require_once( PRIMITIVES . 'primitivePlugin.php' );
require_once( PRIMITIVES . 'primitiveService.php' );
require_once( PRIMITIVES . 'primitiveController.php' );
require_once( PRIMITIVES . 'primitiveApp.php' );