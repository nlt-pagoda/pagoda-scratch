<div id="content">
<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($added)):
$this->RenderMsg("Announcement added!");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Add Announcement</h2>




<form action="" method="POST">
	<table>
	<tr>
	<td>
	<label for="title">Title:  </label>
	</td>
	<td>
	<input type="text" name="title">
	</td>
	</tr>
	
	<tr>
	<td>
	<label for="announcement">Announcement:  </label>
	</td>
	<td>
	<textarea rows="15" cols="50" name="text"></textarea>
	<tr>
	<td>
	<td>
	<input type="submit" name="submit" value="submit"/>
	</td>
	</td>
	</tr>
	</table>
	
</form>
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>

</div>