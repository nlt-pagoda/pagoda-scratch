<?php if ($accessible): ?>

<h1>Admin Control Panel</h1>

<?php 
if (isset($removed)):
	$this->RenderMsg("User Removed")
?>


<?php 
else: 
if (isset($singleton)): ?>
<h2><?php 
echo $user[0]["User"]["username"];
?></h2>

<?php
	echo "<table>";
	echo "<tr>";
	echo "<td><strong>Full Name:  </strong></td><td>".$profile[0]["Profile"]["firstname"]." ".$profile[0]["Profile"]["lastname"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Email:  </strong></td><td>".$profile[0]["Profile"]["emailAddress"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Banner ID:  </strong></td><td>".$profile[0]["Profile"]["bannerID"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Role:  </strong></td><td>".$role[0]["Role"]["role"]."</td><br/>";
	echo "</tr>";
	echo "</table>";
	
	//remove button
	echo("<form action=\"\" method=\"POST\">");
	echo("<input type=\"hidden\" name=\"UserID\" value=\"".$user[0]["User"]["UserID"]."\" />");
	echo("<input type=\"submit\" name=\"remove\" value=\"Remove\"/>");	
	echo("</form>");
			
?>


<?php 
endif;
endif; ?>

<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>