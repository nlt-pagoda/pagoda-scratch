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
			
		if(isset($_POST['remove']))
		{
			$id = $_POST['UserID'];
			$this->Admin->query("DELETE FROM User_has_Roles WHERE UserID = $id" );
			$this->Admin->query("DELETE FROM Profile WHERE UserID = $id" );
			$this->Admin->query("DELETE FROM User WHERE UserID = $id" );
			$this->set('removed',true);
		}
			
			$this->set("profile",$this->Admin->query("SELECT * FROM Profile WHERE UserID = $num"));
			$this->set("role",$this->Admin->query("SELECT * FROM User_has_Roles INNER JOIN Roles ON Roles.RolesID = User_has_Roles.RolesID WHERE User_has_Roles.UserID = $num"));
			$this->set("user",$this->Admin->query("SELECT * FROM User WHERE UserID = $num"));
			$this->set("singleton",true);
	}
	
	
	function view_users($num)
	{
		if (!empty($num))
		{
			$this->set("users", $this->Admin->query("SELECT username,User.UserID FROM User INNER JOIN User_has_Roles ON User.UserID= User_has_Roles.UserID WHERE RolesID = $num"));
			$this->set("roleSet",true);
		}
		else
			$this->set("roles",$this->Admin->query("SELECT * FROM Roles"));
	}
	
	function add_user()
	{
		
		$this->set("roles",$this->Admin->query("SELECT * FROM Roles"));
		
		if(isset($_POST['submit']))
		{
			$u = mysql_real_escape_string($_POST['username']);
			$p = mysql_real_escape_string($_POST['password']);
			$r = mysql_real_escape_string($_POST['role']);
			$firstName = mysql_real_escape_string($_POST['firstname']);
			$lastName = mysql_real_escape_string($_POST['lastname']);
			$bannerID = mysql_real_escape_string($_POST['bannerID']);
			$email = mysql_real_escape_string($_POST['email']);
		
			if($u == "" || $p == "" || $r == "" || $firstName == "" || $lastName == "" || $bannerID =="" || $email == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$this->Admin->query("INSERT INTO User (username,password) VALUES (\"$u\",\"$p\")");
				$userID = $this->Admin->getInsertId();
				$this->Admin->query("INSERT INTO User_has_Roles (UserID,RolesID) VALUES ($userID,$r)");
				$this->Admin->query("INSERT INTO Profile (firstname,lastname,bannerID,emailAddress,UserID) VALUES (\"$firstName\",\"$lastName\",\"$bannerID\",\"$email\",$userID)");
				$this->set('added',true);
			}
		
		
		}
	
	}
	
	function add_student()
	{
		$this->set('students',$this->Admin->query("SELECT * FROM User INNER JOIN User_has_Roles ON User.UserID = User_has_Roles.UserID WHERE User_has_Roles.RolesID = 2"));
		$this->set('courses',$this->Admin->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID"));

		if(isset($_POST['submit']))
		{
			$studentID = $_POST['userID'];
			$courseID = $_POST['courseID'];
			$this->Admin->query("INSERT INTO Course_has_Students (CourseID,StudentID) VALUES (\"$courseID\",\"$studentID\")");
			$this->set('added',true);
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
				$firstName = mysql_real_escape_string($_POST['firstname']);
				$lastName = mysql_real_escape_string($_POST['lastname']);
				$email = mysql_real_escape_string($_POST['email']);
				$uID = mysql_real_escape_string($_POST['userID']);
				$bannerID = mysql_real_escape_string($_POST['bannerID']);
				$this->Admin->query("UPDATE Profile SET firstname = \"$firstName\", lastname = \"$lastName\", emailAddress = \"$email\", bannerID = \"$bannerID\" WHERE userID = $uID");

				$this->set('edited',true);
			}
		}
		
		$this->set("users",$this->Admin->query("SELECT * FROM User ORDER BY username"));
	}
	
	function add_course()
	{
		//Need to add error checking for fields. eg: check Number field contains only numbers		
		$this->set("instructors",$this->Admin->query("SELECT firstname, lastname, User_has_Roles.UserID FROM Profile INNER JOIN User_has_Roles ON Profile.UserID = User_has_Roles.UserID WHERE User_has_Roles.RolesID = 3"));
	    $this->set("departments",$this->Admin->query("SELECT * FROM Department"));
		
	    if(isset($_POST['submit']))
		{
			$deptID = mysql_real_escape_string($_POST['departmentID']);
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
				$this->Admin->query("INSERT INTO Course (DepartmentID,CRN,name,section,number,InstructorID) VALUES (\"$deptID\", \"$crn\",\"$name\",\"$section\",\"$number\",$instructorID)");
				$this->set('added',true);
			}

		}
	
	}
	
	function add_department()
	{
		if(isset($_POST['submit']))
		{
			$name = mysql_real_escape_string($_POST['name']);
			$name = ucwords($name);
			$abbrev = mysql_real_escape_string($_POST['abbrev']);
			$abbrev = strtoUpper($abbrev);
			
			if($abbrev == "" || $name == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$this->Admin->query("INSERT INTO Department (abbreviation,name) VALUES (\"$abbrev\",\"$name\")");
				$this->set('added',true);
			}

		}
	}
	
	function view_courses($num)
	{
		if (!empty($num))
		{		
			$this->set("instructor",$this->Admin->query("SELECT firstname, lastname FROM Profile INNER JOIN Course ON Profile.UserID = Course.InstructorID WHERE Course.CourseID = $num"));
			$this->set('course',$this->Admin->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE CourseID = $num"));
			$this->set("singleton",true);
		}
		else
			$this->set("courses",$this->Admin->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID ORDER BY Department.abbreviation"));
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
				$this->Admin->query("DELETE u.* FROM User_has_Announcement u INNER JOIN Announcement uu ON u.AnnouncementID = uu.AnnouncementID WHERE uu.CourseID = $courseID");
				$this->Admin->query("DELETE FROM Announcement WHERE CourseID = $courseID" );
				$this->Admin->query("DELETE FROM Course_has_Students WHERE CourseID = $courseID" );
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
		
		$this->set('courses',$this->Admin->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID ORDER BY abbreviation"));
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