<?php if ($accessible): ?>

<?php if (isset($added))
{
	$this->RenderMsg("Student added to course.");
}
?>

<h1>Admin Control Panel</h1>

<h2>Add Student to course</h2>

<form action="" method="POST">
	<label for="username">Username:  </label>
	<select name="userID">
	<option value="" selected="selected" disabled="disabled">Select</option>
	<?php
		foreach($students as $student)
		{
			echo "<option value=\"".$student["User"]["UserID"]."\">".$student["User"]["username"]."</option>";
		}
	?>
	</select>
	<br/><br/>
	<label for="course">Course:  </label>
	<select name="courseID">
	<option value="" selected="selected" disabled="disabled">Select</option>
	<?php
		foreach($courses as $course)
		{
			echo "<option value=\"".$course["Course"]["CourseID"]."\">".$course["Department"]["abbreviation"]."-".$course["Course"]["number"]."-".$course["Course"]["section"]."-".$course["Course"]["name"]."</option>";
		}
	?>
	</select>
	
	<br/><br/>
	<input type="submit" name="submit" value="submit"/></td>
</form>

<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>