<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($removed)):
$this->RenderMsg("Course removed.");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Remove Course</h2>
	<form action="" method="POST">
		<label for="course">Course:</label>
			
		<select name="courseID">
		<?php
			foreach($courses as $course)
			{
				echo "<option value=\"".$course["Course"]["CourseID"]."\">".$course["Course"]["name"]."-".$course["Course"]["number"]."-".$course["Course"]["section"]."</option>";
			}
		?>
		</select>
		<input type="submit" onclick="if(confirm('Are you sure you want to delete this course?\nThere is no undo.')) return true; return false;" name="submit" value="submit"/>
	</form>
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>