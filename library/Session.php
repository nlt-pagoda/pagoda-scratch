<?php
class Session
{

	private $_model;
	function __construct($model)
	{	
		$this->_model = $model;
		
		//disable on local
		//enable on web server
		//session_save_path('/tmp');
		session_start();	
	}
	
	
	//return 0 if successfully logged in, nonzero will throw error
	function logIn($user,$pass)
	{
		$cred = $this->_model->query_old("SELECT * FROM User 
		INNER JOIN User_has_Roles ON User.UserID = User_has_Roles.UserID
		INNER JOIN Roles ON User_has_Roles.RolesID = Roles.RolesID
		WHERE username = '$user' AND password = '$pass'");
		if (!empty($cred[0]))
		{
			$_SESSION['loggedIn'] = true;
			$_SESSION['username'] = $cred[0]["username"];
			$_SESSION['role'] = $cred[0]["role"];
			$_SESSION['id'] = $cred[0]["UserID"];
			return true;
		}
		else
			return false;
	}
	
	function logOut()
	{
		$_SESSION['loggedIn'] = false;
		if (isset($_COOKIE[session_name()])) 
		{
			setcookie(session_name(), '', time()-42000, '/');
		}
		session_destroy();
	}
	

	function isLoggedIn()
	{
		if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']))
			return true;
		else return false;
	}
	
	function getName()
	{
		return $_SESSION['username'];
	}
	
	function getRole()
	{
		return $_SESSION['role'];
	}
}
?>