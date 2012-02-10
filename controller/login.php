<?php
	
	global $session;
	global $view;
	
	if (isset($_POST['login']))
	{
		if ($session->logIn($_POST["uname"],$_POST["password"]))
			header("Location: $_SERVER[PHP_SELF]");
		else
			$view->RenderMsg("Your username and/or password was incorrect.");
	}
	if (isset($_POST['logout']))
	{
		$session->logOut();
		header("Location: $_SERVER[PHP_SELF]"); 
	}
	
	
	
	
?>