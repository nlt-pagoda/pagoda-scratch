<?php 
class StudentController extends Controller
{
	function __construct($model,$controller,$action)
	{
		parent::__construct($model,$controller,$action);
		global $session;
			if($session->isLoggedIn() && $session->getRole() == "Student")
				$this->set('accessible',true);
			else
				$this->set('accessible',false);
	}
	
	function view_courses()
	{
		global $session;
		$userID = $session->getID();
		$this->set('courses',$this->Student->query("SELECT * FROM Course INNER JOIN Course_has_Students ON Course.CourseID = Course_has_Students.CourseID INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE Course_has_Students.StudentID = $userID"));
	}
	
	function view_course($num)
	{
		if (!empty($num))
		{	
			$this->set("announcements",$this->Student->query("SELECT AnnouncementID,title,text,date FROM Announcement WHERE AnnouncementTypeID = 2 AND CourseID = \"$num\" ORDER BY date DESC LIMIT 2"));
			$this->set("studentCount",$this->Student->query("SELECT COUNT(StudentID) FROM Course_has_Students WHERE CourseID = $num"));
			$this->set('instructorName',$this->Student->query("SELECT firstname, lastname FROM Profile INNER JOIN Course ON Profile.UserID = Course.InstructorID WHERE Course.CourseID = $num")); 
			$this->set("course",$this->Student->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE CourseID = $num"));
		}
	}
	
	function view_assignments($num)
	{
		 if (!empty($num))
		{	
			$this->set("course",$this->Student->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE CourseID = $num"));
			$this->set("assignments",$this->Student->query("SELECT * FROM Assignment WHERE CourseID = $num" ));					
		}
	}
	
	function view_assignment($num)
	{
		 if (!empty($num))
		{	
			$this->set("courseID",$this->Student->query("SELECT CourseID FROM Assignment WHERE AssignmentID = $num"));
			$this->set("assignment",$this->Student->query("SELECT * FROM Assignment WHERE AssignmentID = $num" ));
			$this->set("documents",$this->Student->query("SELECT * FROM Document WHERE AssignmentID = $num" ));

			$this->set("rubric",$this->Student->query("SELECT name FROM Rubric INNER JOIN Assignment ON Rubric.RubricID = Assignment.RubricID WHERE AssignmentID = $num"));
			$this->set("tablesize",$this->Student->query("SELECT columnSize,rowSize FROM Rubric INNER JOIN Assignment ON Rubric.RubricID = Assignment.RubricID WHERE AssignmentID = $num"));
			$this->set("scores",$this->Student->query("SELECT score,Score.title FROM Score INNER JOIN Assignment ON Score.RubricID = Assignment.RubricID WHERE AssignmentID = $num"));
			$this->set("criterias",$this->Student->query("SELECT Criteria.title FROM Criteria INNER JOIN Assignment ON Criteria.RubricID = Assignment.RubricID WHERE AssignmentID = $num"));
			$rubricIDResult = mysql_query("SELECT RubricID FROM Assignment WHERE AssignmentID = $num");
			$rubricID = mysql_result($rubricIDResult,0);
			$this->set("descriptions",$this->Student->query("SELECT Criteria_Description.* FROM Criteria_Description INNER JOIN Criteria ON Criteria_Description.CriteriaID = Criteria.CriteriaID INNER JOIN Score ON Criteria_Description.ScoreID = Score.ScoreID WHERE Criteria.RubricID = $rubricID"));
		}
	}
	
}
