<?php if ($accessible): ?>



<div id=sidepanel>
	<h2>Controls</h2>
	<ul>
	<li><a href="<?php echo BASEPATH; ?>instructor/view/assessments/">View Assessments</a></li>
	<li><a href="<?php echo BASEPATH; ?>instructor/create/assessment/">Create Assessment</a></li>
	</ul>
</div>

<h1>View Assessment</h1>

<h2><?php 
echo $assessment[0]["Assessment"]["name"];
?></h2>

<?php 
echo $rubricHTML[0]["Rubric"]["html"];
?>


<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
