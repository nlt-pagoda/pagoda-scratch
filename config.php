<?php
	//ROOT will refer the directory above the root site directory.
	//This may be useful for security reasons.
	
	//define('ROOT', dirname(__FILE__)."\\"); - does not work onglobal site
	define('ROOT', dirname(__FILE__)."/"); // Works on global and wamp server
	
	//BASEPATH must be used to reference css, js, and images.
	//This allows for dynamic path finding
	define('BASEPATH', dirname($_SERVER['PHP_SELF']).'/');
	
	//to prevent can not modify header error, use this to write html to buffer
	ob_start();

	//SET DATABASE SETTINGS HERE
	define('DB_HOST',"pagodanlt2.db.8810539.hostedresource.com");
	define('DB_USER',"pagodanlt2");
	define('DB_PASS',"Csci410");
	define('DB_NAME',"pagodanlt2");
	
	//SET SPECIAL ROUTING URLS HERE
	$routing = array(
	
	//'/admin\/(.*?)\/(.*?)/' => 'admin/\1_\2'
	'/admin\/(.*?)\/(.*?)\/(.*)/' => 'admin/\1_\2/\3',
	'/ajax\/(.*?)\/(.*?)\/(.*)/' => 'ajax/\1_\2/\3'
	
	);
	
	//The default page to render if there are no parameters in the url
	$default['controller'] = "main";
	$default['action'] = '';
	