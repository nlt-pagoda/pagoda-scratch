<?php
	//root, basepath, obstart, and database settings moved to config.php
	require("config.php");
	
	/*remove leading slash to make path relative for webhosting */
	//require and load objects. using __autoload automates this process
	//so that we dont have to write out the includes for every
	//class we need
	function __autoload($className) {
		if (file_exists('library/'.$className.'.php')) {
			require_once('library/'.$className.'.php');
		} else if (file_exists('controller/'.$className.'.php')) {
			require_once('controller/'.$className.'.php');
		} else if (file_exists('model/'.$className.'.php')) {
			require_once('model/'.$className.'.php');
		} else {
			//echo $className." not found in library. This is a serious error that needs to be fixed if the site is live.";
		}
	}
	
	//Session now gets defined with the controller
	//in order to encapsulate the model/query stuff.
	//$session can still be obtained globally, however.
	$session = "";

	//Grabs the URL.
	//Remember, the format of the url is
	//  pagoda/controller/action/queries
	if (isset($_GET['url']))
		$url = $_GET['url'];

	
	
	//These next set of functions "sanitize" superglobals-- that is, 
	//remove their slashes and "magic quotes"
	function stripSlashesDeep($value) {
		$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
		return $value;
	}
	function removeMagicQuotes() {
		if ( get_magic_quotes_gpc() ) {
			$_GET    = stripSlashesDeep($_GET   );
			$_POST   = stripSlashesDeep($_POST  );
			$_COOKIE = stripSlashesDeep($_COOKIE);
		}
	}
	function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}
	
	//This is the main function. will take in url and
	//process the controller, model, and actions.
	//remember that controller processes the view.
	function processMVC() {
		global $url;
		global $default;

		if (!isset($url)) {
			$controller = $default['controller'];
			$action = $default['action'];
		} else {
			$url = routeURL($url);
			$urlArray = array();
			$urlArray = explode("/",$url);
			$controller = $urlArray[0];
			array_shift($urlArray);
			if (isset($urlArray[0])) {
				$action = $urlArray[0];
				array_shift($urlArray);
			} else {
				$action = 'index'; // Default Action
			}
			$queryString = $urlArray;
			
			
		}
		$controllerName = $controller;
		$controller = ucwords($controller);
		$model = class_exists($controller) ? rtrim($controller, 's') : "Error";
		$controller .= 'Controller';
		$dispatch = class_exists($controller) ? new $controller($model,$controllerName,$action) : new ErrorController($model,$controllerName,$action);

		if ((int)method_exists($controller, $action)) {
			call_user_func_array(array($dispatch,$action),$queryString);
		} else {
			/* generate error code */
		}
	}
	
	
	//URL redirection based on some regular expression matches
	//defined in config.php
	function routeURL($url) {
		global $routing;

		foreach ( $routing as $pattern => $result ) {
				if ( preg_match( $pattern, $url ) ) {
					return preg_replace( $pattern, $result, $url );
				}
		}
		return ($url);
	}
	
	
	
	//Call the functions.
	removeMagicQuotes();
	unregisterGlobals();
	processMVC();
