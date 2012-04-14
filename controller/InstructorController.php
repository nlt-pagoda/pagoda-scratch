<?php 
class InstructorController extends Controller
{
	function __construct($model,$controller,$action)
	{
		parent::__construct($model,$controller,$action);
		global $session;
			if($session->isLoggedIn() && $session->getRole() == "Instructor")
				$this->set('accessible',true);
			else
				$this->set('accessible',false);
	}

	function view_courses()
	{
		global $session;
		$userID = $session->getID();
		$this->set('courses',$this->Instructor->query("SELECT * FROM `Course` INNER JOIN User ON Course.InstructorID = User.UserID INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE User.UserID = $userID"));
	}
	
	function view_course($num)
	{
		if(isset($_POST['remove']))
		{
			$id = $_POST['AnnouncementID'];
			$this->set('courseID',$num);
			$this->Instructor->query("DELETE FROM User_has_Announcement WHERE AnnouncementID = $id" );
			$this->Instructor->query("DELETE FROM Announcement WHERE AnnouncementID = $id" );
			$this->set('removed',true);
		}
		
		else if (!empty($num))
		{	
			$this->set("announcements",$this->Instructor->query("SELECT AnnouncementID,title,text,date FROM Announcement WHERE AnnouncementTypeID = 2 AND CourseID = \"$num\" ORDER BY date DESC LIMIT 2"));
			$this->set("studentCount",$this->Instructor->query("SELECT COUNT(StudentID) FROM Course_has_Students WHERE CourseID = $num"));
			$this->set("students",$this->Instructor->query("SELECT firstname, lastname,UserID FROM Profile INNER JOIN Course_has_Students ON Profile.UserID = Course_has_Students.StudentID WHERE Course_has_Students.CourseID =  $num ORDER BY Profile.lastname"));	
			$this->set("course",$this->Instructor->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE CourseID = $num"));
			
		}
		
	}
	function add_assignment()
	{
		global $session;
		if(isset($_POST['submit'])){
			//WILL UPDATE ONCE THE DATABASE IS CHANGED.
			//STATUS:- DISCUSSION WITH TEAM.
		}
	}

	function create_assessment()
	{
		global $session;
		if(isset($_POST['submit']))
		{
			$instructorID = $session->getID();
			$name = mysql_real_escape_string($_POST['name']);
			$this->Instructor->query("INSERT INTO Assessment (InstructorID,name) VALUES (\"$instructorID\",\"$name\")");
			$this->set('added',true);
		}
	}
	
	function view_assessments()
	{
		global $session;
		$userID = $session->getID();
		$this->set('assessments',$this->Instructor->query("SELECT Assessment.* FROM `Assessment` INNER JOIN User ON Assessment.InstructorID = User.UserID WHERE Assessment.InstructorID = $userID"));
	}
		
	function add_announcement($num)
	{
		global $session;
		if(isset($_POST['submit']))
		{
			$courseID = $num;
			$title = mysql_real_escape_string($_POST['title']);
			$text = mysql_real_escape_string($_POST['text']);
			$typeID = 2; //instructorAnnouncement type = 2 
			$userID = $session->getID();
			
			if($title == "" || $text == "")
			{
				$this->set('missing',true);
			}
			else
			{
				$this->Instructor->query("INSERT INTO Announcement (title,text,date,AnnouncementTypeID,CourseID) VALUES (\"$title\",\"$text\",localtime(),\"$typeID\",\"$courseID\")");
				$AnnouncementID = mysql_insert_id();
				$this->Instructor->query("INSERT INTO User_has_Announcement (UserID,AnnouncementID) VALUES (\"$userID\",\"$AnnouncementID\")");
				$this->set('added',true);
			}
		}	
	}
	
	function view_student($num)
	{
			$this->set("profile",$this->Instructor->query("SELECT * FROM Profile WHERE UserID = $num"));
			$this->set("user",$this->Instructor->query("SELECT * FROM User WHERE UserID = $num"));
	}
}
