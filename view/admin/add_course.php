<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($added)):
$this->RenderMsg("Course added!");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Add Course</h2>




<form action="" method="POST">
	<table>
	<tr>
	<td>
	<label for="instructor">Instructor:  </label>
	<td>
	<select name="instructor">
	<?php
	foreach($instructors as $instructor)
		echo "<option value=\"".$instructor["User_has_Role"]["UserID"]."\">".$instructor["Profile"]["firstname"]." ".$instructor["Profile"]["lastname"]."</option>";
		echo $instructor;
		?>
	</select>
	</td>
	</tr>
	<tr>
	<td>
	<label for="department">Department:  </label>
	<td>
	<select name="departmentID">
	<?php
	foreach($departments as $department)
		echo "<option value=\"".$department["Department"]["DepartmentID"]."\">".$department["Department"]["name"]." (".$department["Department"]["abbreviation"].")</option>";
		?>
	</select>
	</td>
	</tr>
	</table>
	
	<br />
	
	<table>
	<h3>Course info:</h3><br />
	<tr>
	<td><label for="CRN">CRN:  </label></td><td><input type="text" name="CRN" /></td>
	</tr>
	<tr>
	<td><label for="name">Course Name:  </label></td><td><input type="text" name="name" /></td>
	</tr>
	<tr>
	<td><label for="number">Number:  </label></td><td><input type="text" name="number" size="60"/></td>
	</tr>
	<tr>
	<td><label for="section">Section:  </label></td><td><input type="text" name="section" size="60"/></td>
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
