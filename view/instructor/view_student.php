<?php if ($accessible): ?>

<h1>Admin Control Panel</h1>

<?php 
echo $profile[0]["Profile"]["firstName"]." ".$profile[0]["Profile"]["lastName"];
?></h2>

<?php
	echo "<table>";
	echo "<tr>";
	echo "<td><strong>Full Name:  </strong></td><td>".$profile[0]["Profile"]["firstName"]." ".$profile[0]["Profile"]["lastName"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Email:  </strong></td><td>".$profile[0]["Profile"]["emailAddress"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Banner ID:  </strong></td><td>".$profile[0]["Profile"]["bannerID"]."</td><br/>";
	echo "</tr>";
	echo "</table>";

			
?>




<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>