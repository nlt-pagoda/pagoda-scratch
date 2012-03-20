<?php
	
	global $session;

	if (isset($_POST['login']))
	{
		if ($session->logIn($_POST["uname"],$_POST["password"]))
		{
			header("Location: $_SERVER[REQUEST_URI]");
			ob_end_flush(); //ending ob_start();
		}
		else
			$this->RenderMsg("Your username and/or password was incorrect.");
	}
	if (isset($_POST['logout']))
	{
		$session->logOut();
		header("Location:".BASEPATH);
		ob_end_flush();	//ending ob_start();	
	}
	
	
	
	
?>
