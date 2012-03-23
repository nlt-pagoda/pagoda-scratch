<?php if ($accessible): ?>

<h1>Instructor Control Panel</h1>
<h2>My Courses</h2>

<?php 
foreach ($courses as $course)
	echo("<a href=\"../course/".$course["Course"]["CourseID"]."\">".$course["Department"]["abbreviation"]."-".$course["Course"]["number"]."-".$course["Course"]["section"]."-".$course["Course"]["name"]."</a><br/>");
?>




<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>