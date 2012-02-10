
<head>
<link rel="stylesheet" type="text/css" href="view/css/homepageStyle.css" />
</head>
<div id=header>
	<div id="banner">
		Pagoda
	</div>
	<div id="login">
	
<?php 
	global $session;
	if ($session->isLoggedIn())
	{
?>
	<div id="nametag">
		<form method="POST" name="logout" action=<?php echo $_SERVER['PHP_SELF']; ?>>
		Welcome, <?php echo $session->getName()." (".$session->getRole().")"?>
		<input name="logout" type="hidden" value="Log Out"/>
		</form>
	</div>	
<?php
	}
else 
	{
?>
	<form method="POST" action=<?php echo $_SERVER['PHP_SELF']; ?>>
		Username: <input type="text" name="uname" /> Password: <input type="password" name="password" />
		<input name="login" type="submit" value="Log In" />
	</form>
<?php 
	}
?>

	</div>	
</div>	
