<?php
	//ROOT will refer the directory above the root site directory.
	//This may be useful for security reasons.
	define('ROOT', dirname(dirname(__FILE__)));
	
	//BASEPATH must be used to reference css, js, and images.
	//This allows for dynamic path finding
	define('BASEPATH', dirname($_SERVER['PHP_SELF']).'/');
	
	/*remove leading slash to make path relative for webhosting */
	//require and load objects
	require ("model/Database.php");
	require ("view/View.php");
	require ("controller/Session.php");
	$session = new Session();
	$db = new Database();
	$view = new View();

	//Grab the url and splitting it into parts.
	if (isset($_GET['url']))
		$url = splitUrl($_GET['url']);
	else
		$url = array("main","","");
	
	//Render the header and the navbar.
	$view->RenderHeader();
	$view->RenderNavBar();
	
	//Since we are rendering messages in the login controller,
	//in order to keep the view in order we must require it here
	//(probably can fix this)
	/*remove leading slash to make path relative for webhosting */
	require ("controller/login.php");
	
	//renders controller content based on url
	$view->render($url);
	
	//render the footer. done.
	$view->RenderFooter();
	

	
	//This function splits the url by each slash (/).
	//This combined with the htaccess rewrite module will allow us
	//to make clean (SEO-friendly) urls e.g.
	// > pagoda/admin/edit/users
	// > pagoda/assignments/view/csci413
	// the format is
	//  pagoda/controller/action/queries
	function splitUrl($url)
	{
		$urlArray = array();
		$urlArray = explode("/",$url);
		return $urlArray;
	}
?>