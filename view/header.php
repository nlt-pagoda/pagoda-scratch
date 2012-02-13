<?php
//to prevent can not modify header error, use this to write html to buffer
ob_start();
?>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo BASEPATH; ?>/view/css/basicStyle.css" />
<?php
	global $view;
	$view->SetCSS();
?>

</head>
<div id="header">
	<div id="banner">
		Pagoda
	</div>
	<div id="login">
	
<?php 

	//This controls the login/logout header on the top of each page.

	global $session;
	if ($session->isLoggedIn())
	{
?>
	<div id="nametag">
		<form method="POST" name="logout" action="">
		Welcome, <?php echo $session->getName()." (".$session->getRole().")"?>
		<input name="logout" type="hidden" value="Log Out"/>
		</form>
	</div>	
<?php
	}
else 
	{
?>
	<form method="POST" action="">
		Username: <input type="text" name="uname" /> Password: <input type="password" name="password" />
		<input name="login" type="submit" value="Log In" />
	</form>
<?php 
	}
?>

	</div>	
</div>	
