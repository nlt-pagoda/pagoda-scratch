<?php
	
	
	require ("/model/Database.php");
	require ("/view/View.php");
	require ("/controller/Session.php");
	$session = new Session();
	$db = new Database();
	$view = new View();

	$view->RenderHeader();
	$view->RenderNavBar();
	require '/controller/login.php';
	require("/controller/main.php");
	$view->RenderFooter();
?>