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
			$this->set("role",$this->Admin->query("SELECT * FROM User_has_Roles INNER JOIN Roles ON Roles.RolesID = User_has_Roles.RolesID WHERE User_has_Roles.UserID = $num"));
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
				$this->Admin->query("INSERT INTO User_has_Roles (UserID,RolesID) VALUES ($userID,$r)");
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
				$this->Admin->query("DELETE FROM User_has_Roles WHERE UserID = $uID" );
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
	
	function add_course()
	{
		//Need to add error checking for fields. eg: check Number field contains only numbers		
		$this->set("instructors",$this->Admin->query("SELECT fullName, User_has_Roles.UserID FROM Profile INNER JOIN User_has_Roles ON Profile.UserID = User_has_Roles.UserID WHERE User_has_Roles.RolesID = 3"));
	
		if(isset($_POST['submit']))
		{
			$crn = mysql_real_escape_string($_POST['CRN']);
			$name = mysql_real_escape_string($_POST['name']);
			$number = mysql_real_escape_string($_POST['number']);
			$section = mysql_real_escape_string($_POST['section']);
			$instructorID = mysql_real_escape_string($_POST['instructor']);
					
			
			if($crn == "" || $name == "" || $number == "" || $section == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$this->Admin->query("INSERT INTO Course (CRN,name,section,number,InstructorID) VALUES (\"$crn\",\"$name\",\"$section\",\"$number\",$instructorID)");
				$this->set('added',true);
			}

		}
	
	}
	
	function view_courses($num)
	{
		if (!empty($num))
		{		
			$this->set("instructor",$this->Admin->query("SELECT fullName FROM Profile INNER JOIN Course ON Profile.UserID = Course.InstructorID WHERE Course.CourseID = $num"));
			$this->set("course",$this->Admin->query("SELECT CRN,name,section,number FROM Course WHERE CourseID = $num"));
			$this->set("singleton",true);
		}
		else
			$this->set("courses",$this->Admin->query("SELECT name,section,number,CourseID FROM Course ORDER BY name"));
	}
	
	function remove_course()
	{	
		if(isset($_POST['submit']))
		{
			if($_POST['courseID'] == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$courseID = mysql_real_escape_string($_POST['courseID']);
				$this->Admin->query("DELETE FROM Course WHERE CourseID = $courseID" );
				$this->set('removed',true);
			}
		}
		
		$this->set("courses",$this->Admin->query("SELECT CourseID,name,number,section FROM Course ORDER BY name"));
	}
	
	function edit_course()
	{
		if(isset($_POST['submit']))
		{
			if($_POST['courseID'] == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$courseID = mysql_real_escape_string($_POST['courseID']);
				$name = mysql_real_escape_string($_POST['name']);
				$number = mysql_real_escape_string($_POST['number']);
				$section = mysql_real_escape_string($_POST['section']);
				$crn = mysql_real_escape_string($_POST['crn']);
				$this->Admin->query("UPDATE Course SET name = \"$name\", number = \"$number\", section = \"$section\", CRN = \"$crn\" WHERE CourseID = $courseID");

				$this->set('edited',true);
			}
		}
		
		$this->set("courses",$this->Admin->query("SELECT CourseID,name,number,section FROM Course ORDER BY name"));
	}
	
	function add_announcement()
	{
		global $session;
		if(isset($_POST['submit']))
		{
			$title = mysql_real_escape_string($_POST['title']);
			$text = mysql_real_escape_string($_POST['text']);
			$typeID = 1; //Headline type = 1 
			$userID = $session->getID();
			
			if($title == "" || $text == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$this->Admin->query("INSERT INTO Announcement (title,text,date,AnnouncementTypeID) VALUES (\"$title\",\"$text\",localtime(),\"$typeID\")");
				$AnnouncementID = mysql_insert_id();
				$this->Admin->query("INSERT INTO User_has_Announcement (UserID,AnnouncementID) VALUES (\"$userID\",\"$AnnouncementID\")");
				$this->set('added',true);
			}
		}	
	}
}