<div id="navigation">
	<span id="navigationItems">
	<ul><li><a href="<?php echo BASEPATH; ?>">Home</a></li> <li><a href="<?php echo BASEPATH."about"; ?>">About Us</a></li>
	
	<?php global $session;
	if($session->isLoggedIn() && $session->getRole() == "Administrator")
	{
	?>
	<li><a href="<?php echo BASEPATH."admin"; ?>">Admin CP</a></li>
	<?php } ?>
	</ul>	
	</span>
</div>
<div id="wrapper">