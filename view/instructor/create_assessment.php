<?php if ($accessible): ?>

<?php if (isset($added)):
$this->RenderMsg("Assessment created!");
endif ?>

<div id=sidepanel>
	<h2>Controls</h2>
	<ul>
	<li><a href="<?php echo BASEPATH; ?>instructor/view/assessments/">View Assessments</a></li>
	<li><a href="<?php echo BASEPATH; ?>instructor/create/assessment/">Create Assessment</a></li>
	</ul>
</div>

<h1>Assessments</h1>


<form action="" method="POST">
	<table>
	<tr>
	<td><label for="name">Assessment Name:  </label></td><td><input type="text" name="name" /></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="submit"/></td>
	</tr>
	</table>
</form>
	



<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
