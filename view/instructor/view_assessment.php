<?php if ($accessible): ?>
<?php if (isset($removed)):
header('Location:'.BASEPATH.'/instructor/view/assessments/');
endif ?>


<div id=sidepanel>
<?php $this->assessmentSidePanel(); ?>
</div>

<h1>View Assessment</h1>

<h2><?php 
echo $assessment[0]["Assessment"]["name"];
?></h2>

<?php 
echo $rubricHTML[0]["Rubric"]["html"];

			if ($accessible)
			{
				echo("<div id=\"announcementButtons\"><form action=\"\" method=\"POST\">");
				echo("<input type=\"submit\" name=\"remove\" value=\"Remove\"/>");
				echo("</form></div>");
			}
?>


<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
