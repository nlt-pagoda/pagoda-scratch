<?php 
class MainController extends Controller {
	
	function __construct($model,$controller,$action)
	{
		parent::__construct($model,$controller,$action);
	
		//call Headlines
		$this->set("headlines",$this->Main->query("SELECT title,text,date FROM Announcement WHERE AnnouncementTypeID = 1"));
	
	}
}
?>