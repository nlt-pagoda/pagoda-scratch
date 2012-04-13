<?php if ($accessible): ?>

<div id=sidepanel>
	<h2>Controls</h2>
	<ul>
	<li><a href="<?php echo BASEPATH; ?>instructor/view/assessments/">View Assessments</a></li>
	<li><a href="<?php echo BASEPATH; ?>instructor/create/assessment/">Create Assessment</a></li>
	</ul>
</div>
 
<h1>Assessments</h1>
<ul>
<?php 
foreach ($assessments as $assessment)
	echo("<li><a href=\"\">".$assessment["Assessment"]["name"]."</a><br/></li>");
?>
</ul>




<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
