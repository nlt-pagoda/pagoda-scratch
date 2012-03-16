<div id="navigationBar">
	<div id="navigationItems">
	<ul><li><a href="<?php echo BASEPATH; ?>">Home</a></li> <li><a href="<?php echo BASEPATH."main/about"; ?>">About Us</a></li>
	
	<?php global $session;
	if($session->isLoggedIn() && $session->getRole() == "Administrator")
	{
	?>
	<li><a href="<?php echo BASEPATH."admin"; ?>">Admin CP</a></li>
	
	<?php 
	}
	if($session->isLoggedIn() && $session->getRole() == "Instructor")
	{
	?>
	<li><a href="<?php echo BASEPATH."instructor"; ?>">Instructor CP</a></li>
	
	<?php 
	}
	if($session->isLoggedIn() && $session->getRole() == "Student")
	{
	?>
	<li><a href="<?php echo BASEPATH."student"; ?>">Student CP</a></li>
	
	<li><a href="javascript:document.forms['logout'].submit();">Log Out</a></li>
	<?php } else if($session->isLoggedIn()) { ?>
	<li><a href="javascript:document.forms['logout'].submit();">Log Out</a></li>
	<?php } ?>
	</ul>	
	</div>
</div>
<div id="wrapper">

<div id="content">
