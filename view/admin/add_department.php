<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($added)):
$this->RenderMsg("Department added!");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Add Department</h2>




<form action="" method="POST">
	<table>
	<tr>
	<td>
	<label for="name">Name:</label><td><input type="text" name="name" /></td>
	<td>
	</td>
	</tr>
	<tr>
	<td>
	<label for="abbreviation">Abbreviation:</label><td><input type="text" name="abbrev" maxlength="4" style="width: 60px;text-transform: uppercase" /></td>
	<td>
	</td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="submit"/></td>
	</tr>
	</table>
</form>
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>
