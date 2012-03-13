<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo BASEPATH; ?>/include/css/basicStyle.css" />
<script type="text/javascript" src="<?php echo BASEPATH; ?>/include/js/jq.js"></script>
<script src="<?php echo BASEPATH; ?>include/js/nicedit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<?php
	$this->SetCSS();
?>

</head>
<body>
<div id="header">
	<div id="banner">
		
		<a href="<?php echo BASEPATH ?>">
		<span id="headerLogo">
		<img src="<?php echo BASEPATH ?>include/img/logoproto1.png" style="height: inherit;" />
		</span>
		</a>
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

