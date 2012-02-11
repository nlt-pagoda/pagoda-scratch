<?php 
	global $session;
	global $view;


	
	
	if($session->isLoggedIn() && $session->getRole() == "Administrator")
	{
	
	if ($action == "view")
		echo "I AM VIEW";
	require ("/view/html/admin.html");
	}
	else
	{
	$view->RenderMsg("You do not have sufficient rights to access this page!");
	}
?>