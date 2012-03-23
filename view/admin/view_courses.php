<?php if ($accessible): ?>

<h1>Admin Control Panel</h1>


<?php if (isset($singleton)): ?>
<h2><?php 
echo $course[0]["Course"]["name"];
?></h2>

<?php
	echo "<table>";
	echo "<tr>";
	echo "<td><strong>Department:  </strong></td><td>".$course[0]["Department"]["name"]."(".$course[0]["Department"]["abbreviation"].")</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Number:  </strong></td><td>".$course[0]["Course"]["number"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Section:  </strong></td><td>".$course[0]["Course"]["section"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>CRN:  </strong></td><td>".$course[0]["Course"]["CRN"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Instructor:  </strong></td><td>".$instructor[0]["Profile"]["firstname"]." ".$instructor[0]["Profile"]["lastname"]."</td><br/>";
	echo "</tr>";
	echo "</table>";
?>

<?php else: ?>
<h2>Listing all courses:</h2>
<?php
foreach ($courses as $course)
	echo("<a href=\"".$course["Course"]["CourseID"]."\">".$course["Department"]["abbreviation"]."-".$course["Course"]["number"]."-".$course["Course"]["section"]."-".$course["Course"]["name"]."</a><br/>");
?>
	
<?php endif; ?>



<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>