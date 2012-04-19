<?php if ($accessible): ?>

<div id=sidepanel>
<?php $this->assessmentSidePanel(); ?>
</div>
 
<h1>Assessments</h1>
<ul>
<?php 
foreach ($assessments as $assessment)
	echo("<li><a href=\"".BASEPATH."instructor/view/assessment/".$assessment["Assessment"]["AssessmentID"]."\">".$assessment["Assessment"]["name"]."</a><br/></li>");
?>
</ul>




<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
