<?php if ($accessible): ?>

<h1>Admin Control Panel</h1>

<?php if(isset($roleSet)):
	foreach ($users as $user)
	echo("<a href=\"../usersingle/".$user["User"]["UserID"]."\">".$user["User"]["username"]."</a><br/>");
	
?>

<?php else: ?>
<h2>Listing all user categories:</h2>
<?php
foreach ($roles as $role)
	echo("<a href=\"".$role["Role"]["RolesID"]."\">".$role["Role"]["role"]."s</a><br/>");
?>
	
<?php endif; ?>



<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
