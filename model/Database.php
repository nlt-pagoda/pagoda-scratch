<?php


class Database {

		
	function __construct() {
		
		//If someone could get this to work, we would have something interesting going on
	 	//$dbHost = "sql100.byetcluster.com";
		//$dbUser = "b17_10179522";
 		//$dbPass = "csci410";
 		//$dbName = "b17_10179522_pagoda";
		$dbHost = "localhost";
		$dbUser = "root";
 		$dbPass = "";
 		$dbName = "pagoda";
		
		
		
		$this->connect($dbHost,$dbUser,$dbPass,$dbName);
	}
	
	public function connect($host,$user,$pass,$database) {
		mysql_connect($host,$user,$pass) or die(mysql_error());
		mysql_select_db($database) or die(mysql_error());
	
	}
	
	public function verifyLoginCredentials($uname,$password)
	{
		global $view;
	//security
		$uname = mysql_escape_string($uname);
		$password = mysql_escape_string($password);
	
			
		//checking for blank fields
			if (!$uname || !$password )
			{
				$view->RenderMsg("You did not complete all the required fields");
				return;
			}	
			
		$uNameCheck = mysql_query("SELECT * FROM user WHERE username = '$uname'")
						or die(mysql_error());
		$uNameCheckResult = mysql_num_rows($uNameCheck);
		
		if($uNameCheckResult == 0)
		{
			$view->RenderMsg("Username does not exist.");
			return;
			
		}
				
		$pwCheck = mysql_fetch_array($uNameCheck);
			
			if($pwCheck["password"] != $password)
			{
				$view->RenderMsg("Incorrect password.");
				return;
			}
			
			
			else 
			{	
				$UserID = $pwCheck["UserID"];
				$rolesid = mysql_query("SELECT RolesID FROM user_has_roles WHERE UserID = $UserID");
				$rolesid = mysql_fetch_array($rolesid);
				$rolesid = $rolesid["RolesID"];
				
				$view->success($rolesid);
				return;
			}
		
		mysql_free_result($uNameCheck);
	}
	
}

?>
