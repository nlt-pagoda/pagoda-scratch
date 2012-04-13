<?php if ($accessible): ?>


<!-- This is in development/testing phase, will be removed if it does not qualify -->
<script type="text/javascript" src="<?php echo BASEPATH.'include/js/validate.js'?>"></script>
<script type="text/javascript">
Validate.id(new Array("title"));
</script>
<!-- ============================================= -->



<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($added)):
$this->RenderMsg("Announcement added!");
endif ?>

<h1>Instructor Control Panel</h1>

<h2>Add Announcement</h2>

<form action="" method="POST">
	<table>
	<tr>
	<td>
	<label for="title">Title:  </label>
	</td>
	<td>
	<input type="text" name="title" id="title">
	</td>
	</tr>
	
	<tr>
	<td>
	<label for="announcement">Announcement:  </label>
	</td>
	<td>
	<textarea id="nicEdittextarea" rows="25" cols="90" name="text"></textarea>
	<tr>
	<td>
	<td>
	<input type="submit" name="submit" value="Submit" id="submit"/>
	</td>
	</td>
	</tr>
	</table>
	
</form>
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>

