<?php
	
	
	
	if (isset($_POST['login']))
	{
	
		$db->verifyLoginCredentials($_POST["uname"],$_POST["password"]);
	
	}
	
		require ("/view/index.html");
	
	
	
?>