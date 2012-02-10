<?php
	
	session_start();
	require ("/model/Database.php");
	require ("/view/View.php");
	$db = new Database();
	$view = new View();

	$view->RenderHeader();
	require("/controller/login.php");
	
?>