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
		$this->set('courses',$this->Student->query("SELECT Course.CourseID,CRN,name,section,number,InstructorID FROM Course INNER JOIN Course_has_Students ON Course.CourseID = Course_has_Students.CourseID WHERE Course_has_Students.StudentID = $userID"));
	}
	
	function view_course($num)
	{
		if (!empty($num))
		{	
			$instructorNameResult = mysql_query("SELECT fullname FROM Profile INNER JOIN Course ON Profile.UserID = Course.InstructorID WHERE Course.CourseID = $num") or die(mysql_error());
			$instructorName = mysql_fetch_array($instructorNameResult);
			$this->set('instructorName',$instructorName['fullname']); 
			$this->set("course",$this->Student->query("SELECT CRN,name,section,number FROM Course WHERE CourseID = $num"));
		}
}
	
}
