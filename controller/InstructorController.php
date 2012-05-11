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
	
	function view_assignments($num)
	{
		/*if(isset($_POST['remove']))
				{
					$id = $_POST['AnnouncementID'];
					$this->set('courseID',$num);
					$this->Instructor->query("DELETE FROM User_has_Announcement WHERE AnnouncementID = $id" );
					$this->Instructor->query("DELETE FROM Announcement WHERE AnnouncementID = $id" );
					$this->set('removed',true);
				}*/
				
				/*else*/ if (!empty($num))
				{	
					$this->set("course",$this->Instructor->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE CourseID = $num"));
					$this->set("assignments",$this->Instructor->query("SELECT * FROM Assignment WHERE CourseID = $num" ));					
				}
	}
	
	function view_assignment($num)
	{
		/*if(isset($_POST['remove']))
				{
					$id = $_POST['AnnouncementID'];
					$this->set('courseID',$num);
					$this->Instructor->query("DELETE FROM User_has_Announcement WHERE AnnouncementID = $id" );
					$this->Instructor->query("DELETE FROM Announcement WHERE AnnouncementID = $id" );
					$this->set('removed',true);
				}*/
				
				/*else*/ if (!empty($num))
				{	
					$this->set("courseID",$this->Instructor->query("SELECT CourseID FROM Assignment WHERE AssignmentID = $num"));
					$this->set("assignment",$this->Instructor->query("SELECT * FROM Assignment WHERE AssignmentID = $num" ));
					$this->set("documents",$this->Instructor->query("SELECT * FROM Document WHERE AssignmentID = $num" ));

					$this->set("rubric",$this->Instructor->query("SELECT name FROM Rubric INNER JOIN Assignment ON Rubric.RubricID = Assignment.RubricID WHERE AssignmentID = $num"));
					$this->set("tablesize",$this->Instructor->query("SELECT columnSize,rowSize FROM Rubric INNER JOIN Assignment ON Rubric.RubricID = Assignment.RubricID WHERE AssignmentID = $num"));
					$this->set("scores",$this->Instructor->query("SELECT score,Score.title FROM Score INNER JOIN Assignment ON Score.RubricID = Assignment.RubricID WHERE AssignmentID = $num"));
					$this->set("criterias",$this->Instructor->query("SELECT Criteria.title FROM Criteria INNER JOIN Assignment ON Criteria.RubricID = Assignment.RubricID WHERE AssignmentID = $num"));
					$rubricIDResult = mysql_query("SELECT RubricID FROM Assignment WHERE AssignmentID = $num");
					$rubricID = mysql_result($rubricIDResult,0);
					$this->set("descriptions",$this->Instructor->query("SELECT Criteria_Description.* FROM Criteria_Description INNER JOIN Criteria ON Criteria_Description.CriteriaID = Criteria.CriteriaID INNER JOIN Score ON Criteria_Description.ScoreID = Score.ScoreID WHERE Criteria.RubricID = $rubricID"));
				}
	}
	
	function add_assignment($id)
	{		
		global $session;
		
		$this->set('courseID',$id);
		
		$userID = $session->getID();
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

		$this->set("rubrics",$this->Instructor->query("SELECT * FROM Rubric"));
			
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
			
			if(isset($_POST['text']))
				$desc = $_POST['text'];
				
			if(isset($_POST['rubrics']))
				$rubricID = $_POST['rubrics'];

		//INSERTING HOMEWORK TO THE DATABASE
			$this->Instructor->query("INSERT INTO `pagodanlt`.`Assignment` (`CourseID`, `title`, `description`, `dueDate`, `RubricID`) VALUES (\"$id\", \"$title\", \"$desc\", '2012-04-20 21:33:09', \"$rubricID\")");
			
			$assignmentID = mysql_insert_id();
			if(isset($_POST['files2Buploaded']))
			{
				foreach($_POST['files2Buploaded'] as $file)
				{
					$this->Instructor->query("INSERT INTO `pagodanlt`.`Document`(`URL`,`dateSubmitted`,`data`,`AssignmentID`,`StudentID`,`grade`) VALUES (\"$file\",'2000-05-11 00:00:00',NULL,\"$assignmentID\",\"$userID\",NULL)");
				}
			}
			$this->set('added',true);
		}
		$this->set("id",$id);

	}

	function create_rubric()
	{		
		if(isset($_POST['submit']))
		{	
			$rubricName = mysql_real_escape_string($_POST['rubricName']);
			$criteria = array();
			$score = array();
			$points = array();
			$description = array();
			$numOfCriteria = $_POST['criteriaLength'];
			$numOfScores = $_POST['scoreLength'];
			$i = 0;
			
			if($_POST['rubricName'] == "")
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
					$points[$i] = mysql_real_escape_string($_POST['pointsPosition'.$i]);
				}
				
				for($i = 1;$i <= $numOfCriteria;$i++)
				{
					for($j = 1;$j <= $numOfScores;$j++)
					{
						$description[$i][$j] = mysql_real_escape_string($_POST['descriptionPosition'.$i.$j]);
					}
				}
				
				$this->Instructor->query("INSERT INTO Rubric (name,rowSize,columnSize) VALUES (\"$rubricName\", \"$numOfCriteria\", \"$numOfScores\")");
				$rubricID = mysql_insert_id();
				
				for($i = 1;$i <= $numOfCriteria;$i++)
				{
					$this->Instructor->query("INSERT INTO Criteria (title,position,RubricID) VALUES (\"$criteria[$i]\",\"$i\", \"$rubricID\")");
					$criteriaID[$i] = mysql_insert_id();
				}
				
				for($i = 1;$i <= $numOfScores;$i++)
				{
					$this->Instructor->query("INSERT INTO Score (title,score,position,RubricID) VALUES (\"$score[$i]\",\"$points[$i]\",\"$i\", \"$rubricID\")");
					$scoreID[$i] = mysql_insert_id();
				}
								
				for($i = 1;$i <= $numOfCriteria;$i++)
				{
					for($j = 1;$j <= $numOfScores;$j++)
					{
						$this->Instructor->query("INSERT INTO Criteria_Description (description,CriteriaID,ScoreID) VALUES (\"{$description[$i][$j]}\",\"$criteriaID[$i]\", \"$scoreID[$j]\")");
					}
				}
				
				$this->set('added',true);
				
			}
			
		}
		else if(isset($_POST['attach']))
		{
			
		}
	}
	
	function view_rubrics()
	{
		global $session;
		$userID = $session->getID();
		$this->set('rubrics',$this->Instructor->query("SELECT RubricID,name FROM `Rubric`"));
	}
	
	function edit_rubrics()
	{
		global $session;
		$userID = $session->getID();
		$this->set('rubrics',$this->Instructor->query("SELECT RubricID,name FROM `Rubric`"));
	}
	
	function edit_rubric($num)
	{
		if(isset($_POST['remove']))
		{			
			$this->Instructor->query("DELETE FROM Rubric WHERE RubricID = $num" );
			$this->Instructor->query("DELETE FROM Criteria WHERE RubricID = $num" );
			$this->Instructor->query("DELETE FROM Score WHERE RubricID = $num" );
			$this->Instructor->query("DELETE FROM Criteria_Description INNER JOIN Criteria ON Criteria_Description.CriteriaID = Criteria.CriteriaID INNER JOIN Score ON Criteria_Description.ScoreID = Score.ScoreID WHERE Criteria.RubricID = $num");
			
			$this->set('removed',true);
		}
		
		if(isset($_POST['submit']))
		{	
			$rubricName = mysql_real_escape_string($_POST['rubricName']);
			$criteria = array();
			$score = array();
			$points = array();
			$description = array();
			$numOfCriteria = $_POST['criteriaLength'];
			$numOfScores = $_POST['scoreLength'];
			$i = 0;
		
		if($_POST['rubricName'] == "")
		{
			$this->set('missing',true);
		}
		
		else
		{
			$this->Instructor->query("DELETE FROM Rubric WHERE RubricID = $num" );
			$this->Instructor->query("DELETE FROM Criteria WHERE RubricID = $num" );
			$this->Instructor->query("DELETE FROM Score WHERE RubricID = $num" );
			$this->Instructor->query("DELETE FROM Criteria_Description INNER JOIN Criteria ON Criteria_Description.CriteriaID = Criteria.CriteriaID INNER JOIN Score ON Criteria_Description.ScoreID = Score.ScoreID WHERE Criteria.RubricID = $num");

			for($i = 1;$i <= $numOfCriteria;$i++)
				{
					$criteria[$i] = mysql_real_escape_string($_POST['criteriaPosition'.$i]);
				}
				
				for($i = 1;$i <= $numOfScores;$i++)
				{
					$score[$i] = mysql_real_escape_string($_POST['scorePosition'.$i]);
					$points[$i] = mysql_real_escape_string($_POST['pointsPosition'.$i]);
				}
				
				for($i = 1;$i <= $numOfCriteria;$i++)
				{
					for($j = 1;$j <= $numOfScores;$j++)
					{
						$description[$i][$j] = mysql_real_escape_string($_POST['descriptionPosition'.$i.$j]);
					}
				}
				
				$this->Instructor->query("INSERT INTO Rubric (RubricID,name,rowSize,columnSize) VALUES (\"$num\", \"$rubricName\", \"$numOfCriteria\", \"$numOfScores\")");
				
				for($i = 1;$i <= $numOfCriteria;$i++)
				{
					$this->Instructor->query("INSERT INTO Criteria (title,position,RubricID) VALUES (\"$criteria[$i]\",\"$i\", \"$num\")");
					$criteriaID[$i] = mysql_insert_id();
				}
				
				for($i = 1;$i <= $numOfScores;$i++)
				{
					$this->Instructor->query("INSERT INTO Score (title,score,position,RubricID) VALUES (\"$score[$i]\",\"$points[$i]\",\"$i\", \"$num\")");
					$scoreID[$i] = mysql_insert_id();
				}
								
				for($i = 1;$i <= $numOfCriteria;$i++)
				{
					for($j = 1;$j <= $numOfScores;$j++)
					{
						$this->Instructor->query("INSERT INTO Criteria_Description (description,CriteriaID,ScoreID) VALUES (\"{$description[$i][$j]}\",\"$criteriaID[$i]\", \"$scoreID[$j]\")");
					}
				}
				
				$this->set('edited',true);
			}
			
		}
				
				
		
		$this->set("rubric",$this->Instructor->query("SELECT name FROM Rubric WHERE RubricID = $num"));
		$this->set("tablesize",$this->Instructor->query("SELECT columnSize,rowSize FROM Rubric WHERE RubricID = $num"));
		$this->set("scores",$this->Instructor->query("SELECT score,title FROM Score WHERE RubricID = $num"));
		$this->set("criterias",$this->Instructor->query("SELECT title FROM Criteria WHERE RubricID = $num"));
		$this->set("descriptions",$this->Instructor->query("SELECT Criteria_Description.* FROM Criteria_Description INNER JOIN Criteria ON Criteria_Description.CriteriaID = Criteria.CriteriaID INNER JOIN Score ON Criteria_Description.ScoreID = Score.ScoreID WHERE Criteria.RubricID = $num"));
		
	}
	
	function view_rubric($num)
	{		
		if (!empty($num))
		{	
			$this->set("rubric",$this->Instructor->query("SELECT name FROM Rubric WHERE RubricID = $num"));
			$this->set("tablesize",$this->Instructor->query("SELECT columnSize,rowSize FROM Rubric WHERE RubricID = $num"));
			$this->set("scores",$this->Instructor->query("SELECT score,title FROM Score WHERE RubricID = $num"));
			$this->set("criterias",$this->Instructor->query("SELECT title FROM Criteria WHERE RubricID = $num"));
			$this->set("descriptions",$this->Instructor->query("SELECT Criteria_Description.* FROM Criteria_Description INNER JOIN Criteria ON Criteria_Description.CriteriaID = Criteria.CriteriaID INNER JOIN Score ON Criteria_Description.ScoreID = Score.ScoreID WHERE Criteria.RubricID = $num"));
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
