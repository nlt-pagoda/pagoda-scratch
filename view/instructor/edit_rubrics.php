<?php if ($accessible): ?>

<div id=sidepanel>
<?php $this->rubricSidePanel(); ?>
</div>
 
<h1>Rubrics</h1>
<ul>
<?php 
foreach ($rubrics as $rubric)
	echo("<li><a href=\"".BASEPATH."instructor/edit/rubric/".$rubric["Rubric"]["RubricID"]."\">".$rubric["Rubric"]["name"]."</a><br/></li>");
?>
</ul>




<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
