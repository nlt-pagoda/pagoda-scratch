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
		if (!empty($num))
		{		
			$this->set("course",$this->Instructor->query("SELECT CRN,name,section,number FROM Course WHERE CourseID = $num"));
		}
		
		
	}
}