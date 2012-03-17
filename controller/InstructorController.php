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
		$this->set('courses',$this->Instructor->query("SELECT CourseID,CRN,name,section,number,InstructorID FROM `Course` INNER JOIN User ON Course.InstructorID = User.UserID WHERE User.UserID = $userID"));
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
			$this->set("course",$this->Instructor->query("SELECT CourseID,CRN,name,section,number FROM Course WHERE CourseID = $num"));
			
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
}
