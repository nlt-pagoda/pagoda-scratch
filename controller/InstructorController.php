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

	function view_courses($message='null')
	{
		global $session;
		$userID = $session->getID();
		$this->set('courses',$this->Instructor->query("SELECT * FROM `Course` INNER JOIN User ON Course.InstructorID = User.UserID INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE User.UserID = $userID"));
		$this->set('message',$message);
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
	function add_assignment($id)
	{
		global $session;
		//Restore the previous texts in the textbox
		if(isset($_SESSION['tmpCourseTitle']))
			$this->set("title",$_SESSION['tmpCourseTitle']);
		else
			$this->set("title",'');
		if(isset($_SESSION['tmpCourseDesc']))
			$this->set("desc",$_SESSION['tmpCourseTitle']);
		else
			$this->set("desc",'');
		//=========================================

		if(isset($_POST['submitAttachFiles']))
		{
			$this->set("files",$_POST['UattachFiles']);
		}
		else
			$this->set("files",null);
		if(isset($_POST['assignHW']))
		{
			if(isset($_POST['title']))
				$title = $_POST['title'];
			if(isset($_POST['files2Buploaded']))
			{
				$fileArray = array();
				foreach($_POST['files2Buploaded'] as $file)
				{
					array_push($fileArray,$file);
				}
			}
			if(isset($_POST['desc']))
				$desc = $_POST['desc'];
			//INSERTING HOMEWORK TO THE DATABASE
			$this->Instructor->query("INSERT INTO `pagodanlt`.`Assignment` (`AssignmentID`, `CourseID`, `title`, `description`, `dueDate`, `AssessmentID`) VALUES (NULL, '3', 'oh hai there', 'i am the description', '2012-04-20 21:33:09', '60'");
		}
		$this->set("id",$id);

	}

	function create_assessment()
	{
		global $session;
		
		if(isset($_POST['submit']))
		{	
			$instructorID = $session->getID();
			$assessmentName = mysql_real_escape_string($_POST['assessmentName']);
			$rubricName = mysql_real_escape_string($_POST['rubricName']);
			$criteria = array();
			$score = array();
			$numOfCriteria = $_POST['criteriaLength'];
			$numOfScores = $_POST['scoreLength'];
			$i = 0;
			
			if($_POST['assessmentName'] == "" || $_POST['rubricName'] == "")
			{
				$this->set('missing',true);
			}
			
			else
			{
				for($i = 1;$i <= $numOfCriteria;$i++)
				{
					$criteria[$i] = mysql_real_escape_string($_POST['criteriaPosition'.$i]);
				}
				
				for($i = 1;$i <= $numOfScores;$i++)
				{
					$score[$i] = mysql_real_escape_string($_POST['scorePosition'.$i]);
				}

				
				$this->Instructor->query("INSERT INTO Assessment (InstructorID,name) VALUES (\"$instructorID\",\"$assessmentName\")");
				$assessmentID = mysql_insert_id();
				$this->Instructor->query("INSERT INTO Rubric (name,rowSize,columnSize) VALUES (\"$rubricName\", \"$numOfCriteria\", \"$numOfScores\")");
				$rubricID = mysql_insert_id();
				$this->Instructor->query("UPDATE Assessment SET RubricID = \"$rubricID\" WHERE Assessment.AssessmentID = $assessmentID");
				
				for($i = 1;$i <= $numOfCriteria;$i++)
				{
					$this->Instructor->query("INSERT INTO Criteria (title,position,RubricID) VALUES (\"$criteria[$i]\",\"$i\", \"$rubricID\")");
				}
				
				for($i = 1;$i <= $numOfScores;$i++)
				{
					$this->Instructor->query("INSERT INTO Score (title,position,RubricID) VALUES (\"$score[$i]\",\"$i\", \"$rubricID\")");
				}
				
				$this->set('added',true);
				
			}
			
		}
		else if(isset($_POST['attach']))
		{
			
		}
	}
	
	function view_assessments()
	{
		global $session;
		$userID = $session->getID();
		$this->set('assessments',$this->Instructor->query("SELECT Assessment.* FROM `Assessment` INNER JOIN User ON Assessment.InstructorID = User.UserID WHERE Assessment.InstructorID = $userID"));
	}
	
	function view_assessment($num)
	{
		if(isset($_POST['remove']))
		{
			$id = $num;
			$this->Instructor->query("DELETE Rubric FROM Rubric INNER JOIN Assessment ON Rubric.RubricID = Assessment.RubricID WHERE Assessment.AssessmentID = $id" );
			$this->Instructor->query("DELETE FROM Assessment_has_Standard WHERE AssessmentID = $id" );
			$this->Instructor->query("DELETE FROM Assessment WHERE AssessmentID = $id" );
			$this->set('removed',true);
		}
		
		if (!empty($num))
		{	
			$this->set("assessment",$this->Instructor->query("SELECT name FROM Assessment WHERE AssessmentID = $num"));
			
			$rubricID = mysql_result(mysql_query("SELECT RubricID FROM Assessment WHERE AssessmentID = $num"),0);
			//$rubricRowSize = mysql_result(mysql_query("SELECT rowSize FROM Rubric WHERE RubricID = $rubricID"),0);
			//$rubricColumnSize = mysql_result(mysql_query("SELECT columnSize FROM Rubric WHERE RubricID = $rubricColumnSize"),0);
		
			$this->set("assessment",$this->Instructor->query("SELECT name FROM Assessment WHERE AssessmentID = $num"));
			
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
	
	function view_student($num)
	{
			$this->set("profile",$this->Instructor->query("SELECT * FROM Profile WHERE UserID = $num"));
			$this->set("user",$this->Instructor->query("SELECT * FROM User WHERE UserID = $num"));
	}
}
