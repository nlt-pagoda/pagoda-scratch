<?php if ($accessible): ?>

<h1>Instructor Control Panel</h1>
<h2>My Courses</h2>

<?php 
foreach ($courses as $course)
	echo("<a href=\"../course/".$course["Course"]["CourseID"]."\">".$course["Course"]["name"]."-".$course["Course"]["number"]."-".$course["Course"]["section"]."</a><br/>");
?>




<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>