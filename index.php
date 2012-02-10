<?php
	
	session_start();
	require ("/model/Database.php");
<<<<<<< HEAD
	require ("/view/View.php");
=======
	require ("/model/View.php");
>>>>>>> 04774ca50c1f8d6209800290784575d7e486382c
	$db = new Database();
	$view = new View();

	$view->RenderHeader();
	require("/controller/login.php");
	
?>