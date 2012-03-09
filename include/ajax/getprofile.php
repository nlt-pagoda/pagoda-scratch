<?php
include ("../../config.php");
include ("../../library/Database.php");
include ("../../library/Model.php");

class Stuff extends Model{

}

$myStuff = new Stuff();
if (isset($_GET['id']))
{
	$id = mysql_real_escape_string($_GET['id']);

	$stuff = $myStuff->query("SELECT * FROM Profile WHERE UserID = $id");

	echo json_encode($stuff[0]["Profile"]);
	
	
}


?>