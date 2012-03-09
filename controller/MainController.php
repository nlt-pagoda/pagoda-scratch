<?php 
class MainController extends Controller {
	
	function __construct($model,$controller,$action)
	{
		parent::__construct($model,$controller,$action);

		//call Headlines. AccouncementTypeID 1 = Headlines
		$this->set("headlines",$this->Main->query("SELECT title,text,date FROM Announcement WHERE AnnouncementTypeID = 1 ORDER BY date DESC LIMIT 5"));
	
	}
}
?>