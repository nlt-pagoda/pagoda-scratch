<?php if ($accessible): ?>

<?php if (isset($removed)):
header('Location:'.$courseID);
endif ?>

<div id=sidepanel>
	<h2>Controls</h2>
	<ul>
	<li><a href="<?php echo BASEPATH; ?>student/view/assignments/<?php echo $course[0]["Course"]["CourseID"];?>">View Assignments</a></li>
	</ul>
</div>



<h1>Student Control Panel</h1>

<h2><?php 
echo $course[0]["Course"]["name"];
?> - Assignments</h2>

<?php 
foreach ($assignments as $assignment)
	echo("<a href=\"../assignment/".$assignment["Assignment"]["AssignmentID"]."\">".$assignment["Assignment"]["title"]."</a><br/>");
?>





<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
