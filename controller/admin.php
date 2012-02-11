<?php 
	global $session;
	global $view;


	
	
	if($session->isLoggedIn() && $session->getRole() == "Administrator")
	{
	
	if ($action == "view")
		echo "I AM VIEW";
	//remove leading slash to make directoy relative for web hosting
	require ("view/html/admin.html");
	}
	else
	{
	$view->RenderMsg("You do not have sufficient rights to access this page!");
	}
?>