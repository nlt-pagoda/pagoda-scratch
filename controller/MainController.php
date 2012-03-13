<?php 
class MainController extends Controller 
{	
	function __construct($model,$controller,$action)
	{
		parent::__construct($model,$controller,$action);
				global $session;
			if($session->isLoggedIn() && $session->getRole() == "Administrator")
				$this->set('accessible',true);
			else
				$this->set('accessible',false);
		

		//call Headlines. AccouncementTypeID 1 = Headlines
		$this->set("headlines",$this->Main->query("SELECT title,text,date FROM Announcement WHERE AnnouncementTypeID = 1 ORDER BY date DESC LIMIT 5"));
	
	}
	
	function view_headlines()
	{
		//Limit 20
		$this->set("headlines",$this->Main->query("SELECT AnnouncementID,title,text,date FROM Announcement WHERE AnnouncementTypeID = 1 ORDER BY date DESC LIMIT 20"));
		
		if(isset($_POST['remove']))
		{
			$id = $_POST['AnnouncementID'];
			$this->Main->query("DELETE FROM User_has_Announcement WHERE AnnouncementID = $id" );
			$this->Main->query("DELETE FROM Announcement WHERE AnnouncementID = $id" );
			$this->set('removed',true);
		}
	}
}
?>