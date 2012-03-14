<?php if ($accessible): ?>

<h1>Admin Control Panel</h1>


<?php if (isset($singleton)): ?>
<h2><?php 
echo $user[0]["User"]["username"];
?></h2>

<?php
	echo "<table>";
	echo "<tr>";
	echo "<td><strong>Full Name:  </strong></td><td>".$profile[0]["Profile"]["fullName"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Email:  </strong></td><td>".$profile[0]["Profile"]["emailAddress"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Address:  </strong></td><td>".$profile[0]["Profile"]["address"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Role:  </strong></td><td>".$role[0]["Role"]["role"]."</td><br/>";
	echo "</tr>";
	echo "</table>";
?>


<?php endif; ?>

<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>