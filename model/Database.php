<?php


class Database {

		
	function __construct() {
		
<<<<<<< HEAD
	 	$dbHost = "pagodanlt2.db.8810539.hostedresource.com";
		$dbUser = "pagodanlt2";
 		$dbPass = "Csci410";
 		$dbName = "pagodanlt2";
=======
	 	$dbHost = "localhost";
		$dbUser = "root";
 		$dbPass = "";
 		$dbName = "pagoda";
>>>>>>> 04774ca50c1f8d6209800290784575d7e486382c
		
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
			
<<<<<<< HEAD
		$uNameCheck = mysql_query("SELECT * FROM User WHERE username = '$uname'")
=======
		$uNameCheck = mysql_query("SELECT * FROM user WHERE username = '$uname'")
>>>>>>> 04774ca50c1f8d6209800290784575d7e486382c
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
<<<<<<< HEAD
				$rolesid = mysql_query("SELECT RolesID FROM Users_has_Roles WHERE UsersID = $UserID");
=======
				$rolesid = mysql_query("SELECT RolesID FROM users_has_roles WHERE UsersID = $UserID");
>>>>>>> 04774ca50c1f8d6209800290784575d7e486382c
				$rolesid = mysql_fetch_array($rolesid);
				$rolesid = $rolesid["RolesID"];
				
				$view->success($rolesid);
				return;
			}
		
		mysql_free_result($uNameCheck);
	}
	
}

?>
