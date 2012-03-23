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
			$this->set("studentCount",$this->Student->query("SELECT COUNT(StudentID) FROM Course_has_Students WHERE CourseID = $num"));
			$this->set('instructorName',$this->Student->query("SELECT firstname, lastname FROM Profile INNER JOIN Course ON Profile.UserID = Course.InstructorID WHERE Course.CourseID = $num")); 
			$this->set("course",$this->Student->query("SELECT * FROM Course INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE CourseID = $num"));
		}
}
	
}
