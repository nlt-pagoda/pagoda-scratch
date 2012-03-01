<div id="content">
<?php if ($accessible): ?>

<h1>Admin Control Panel</h1>


<?php if (isset($singleton)): ?>
<h2><?php 
echo $user[0]["User"]["username"];
?></h2>

<?php
	echo "Full Name:  ".$profile[0]["Profile"]["fullName"]."<br/>";
	echo "Email:  ".$profile[0]["Profile"]["emailAddress"]."<br/>";
	echo "Address:  ".$profile[0]["Profile"]["address"]."<br/>";
	echo "Role:  ".$role[0]["Role"]["role"]."<br/>";
?>

<?php else: ?>
<h2>Listing all current users:</h2>
<?php
foreach ($users as $user)
	echo("<a href=\"".$user["User"]["UserID"]."\">".$user["User"]["username"]."</a><br/>");
?>
	
<?php endif; ?>



<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>

</div>