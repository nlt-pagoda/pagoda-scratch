<div id="navigationBar">
	<div id="navigationItems">
	
<!-- show menu items if user is logged in	 -->
<?php 
	global $session;
	if ($session->isLoggedIn())
	{
?>
	<ul>
		<li><a href="javascript:alert('Link goes nowhere for now')">Menu Item</a></li>
		<li><a href="javascript:alert('Link goes nowhere for now')">Menu Item</a></li>
		<li><a href="javascript:document.forms['logout'].submit();">Log Out</a></li>
	</ul>
	
<!-- show blank menu items if user is NOT logged in	 -->	
<?php 
	}

	else {
?>
	<ul><li></li></ul>
	
<?php
	 }
?>	
			
	</div>
</div>
<div id="wrapper">