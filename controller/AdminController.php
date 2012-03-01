<?php 

class AdminController extends Controller
{
	function __construct($model,$controller,$action)
	{
		parent::__construct($model,$controller,$action);
		global $session;
			if($session->isLoggedIn() && $session->getRole() == "Administrator")
				$this->set('accessible',true);
			else
				$this->set('accessible',false);
	}
	
	function view_user($num)
	{
		if (!empty($num))
		{
			$this->set("profile",$this->Admin->query("SELECT * FROM Profile WHERE UserID = $num"));
			$this->set("role",$this->Admin->query("SELECT * FROM Users_has_Roles INNER JOIN Roles ON Roles.RolesID = Users_has_Roles.RolesID WHERE Users_has_Roles.UsersID = $num"));
			$this->set("user",$this->Admin->query("SELECT * FROM User WHERE UserID = $num"));
			$this->set("singleton",true);
		}
		else
			$this->set("users",$this->Admin->query("SELECT * FROM User"));
	}
	
	function add_user()
	{
		
		$this->set("roles",$this->Admin->query("SELECT * FROM Roles"));
		
		if(isset($_POST['submit']))
		{
			$u = mysql_real_escape_string($_POST['username']);
			$p = mysql_real_escape_string($_POST['password']);
			$r = mysql_real_escape_string($_POST['role']);
			$fullName = mysql_real_escape_string($_POST['fullname']);
			$email = mysql_real_escape_string($_POST['email']);
			$address = mysql_real_escape_string($_POST['address']);
		
			if($u == "" || $p == "" || $r == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$this->Admin->query("INSERT INTO User (username,password) VALUES (\"$u\",\"$p\")");
				$userID = $this->Admin->getInsertId();
				$this->Admin->query("INSERT INTO Users_has_Roles (UsersID,RolesID) VALUES ($userID,$r)");
				$this->Admin->query("INSERT INTO Profile (fullName,emailAddress,address,UserID) VALUES (\"$fullName\",\"$email\",\"$address\",$userID)");
				$this->set('added',true);
			}
		
		
		}
	
	}

	function remove_user()
	{	
		if(isset($_POST['submit']))
		{
			if($_POST['userID'] == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$uID = mysql_real_escape_string($_POST['userID']);
				$this->Admin->query("DELETE FROM Users_has_Roles WHERE UsersID = $uID" );
				$this->Admin->query("DELETE FROM Profile WHERE UserID = $uID" );
				$this->Admin->query("DELETE FROM User WHERE UserID = $uID" );
				$this->set('removed',true);
			}
		}
		
		$this->set("users",$this->Admin->query("SELECT * FROM User"));
	}
	
	function edit_user()
	{
		if(isset($_POST['submit']))
		{
			if($_POST['userID'] == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$fullName = mysql_real_escape_string($_POST['fullname']);
				$email = mysql_real_escape_string($_POST['email']);
				$address = mysql_real_escape_string($_POST['address']);
				$uID = mysql_real_escape_string($_POST['userID']);
				$this->Admin->query("UPDATE Profile SET fullName = \"$fullName\", emailAddress = \"$email\", address = \"$address\" WHERE userID = $uID");

				$this->set('edited',true);
			}
		}
		
		$this->set("users",$this->Admin->query("SELECT * FROM User ORDER BY username"));
	}
}