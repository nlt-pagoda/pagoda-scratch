<?php
	
	global $session;
	global $view;
	
	if (isset($_POST['login']))
	{
		if ($session->logIn($_POST["uname"],$_POST["password"]))
		{
			header("Location: $_SERVER[REQUEST_URI]");
			ob_end_flush(); //ending ob_start();
		}
		else
			$view->RenderMsg("Your username and/or password was incorrect.");
	}
	if (isset($_POST['logout']))
	{
		$session->logOut();
		header("Location: $_SERVER[REQUEST_URI]");
		ob_end_flush();	//ending ob_start();	
	}
	
	
	
	
?>