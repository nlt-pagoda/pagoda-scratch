<?php
include ("../../config.php");
include ("../../library/Database.php");
include ("../../library/Model.php");

class Stuff extends Model{

}

$myStuff = new Stuff();
if (isset($_GET['id']))
{
	//$stuff = array();
	$id = mysql_real_escape_string($_GET['id']);
	//$result = mysql_query("SELECT * FROM User WHERE UserID = $id") or die(mysql_error());
	//$stuff = mysql_fetch_row($result);
	
	$stuff = $myStuff->query("SELECT * FROM Profile WHERE UserID = $id");
	
	
	//echo $stuff[0]["Profile"]["fullName"];
	
	echo json_encode($stuff[0]["Profile"]);
	
	
}


?>