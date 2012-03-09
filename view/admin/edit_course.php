<script type="text/javascript">
$(document).ready(function(){

	$("select[name=courseID]").change(function(){
		var course = $(this).val();

		$.getJSON("<?php echo BASEPATH; ?>/include/ajax/getcourseinfo.php?id=" + course ,
			function(data) {
			//Should be renamed in future
			$('input[name=name]').val(data.name); 
			$('input[name=number]').val(data.number);
			$('input[name=section]').val(data.section);
			$('input[name=crn]').val(data.CRN);
			});
	
	});
	
});
</script>


<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($edited)):
$this->RenderMsg("Course edited.");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Edit Course Info</h2>
	<form action="" method="POST">
		<label for="course">Course:  </label>
			
		<select name="courseID">
		<option value="" selected="selected" disabled="disabled">Select</option>
		<?php
		foreach($courses as $course)
		echo "<option value=\"".$course["Course"]["CourseID"]."\">".$course["Course"]["name"]."-".$course["Course"]["number"]."-".$course["Course"]["section"]."</option>";
		?>
		</select>
		
		<h3>Course Info:</h3>
		<table>
		<tr>		
		<td><label for="fullname">Name:  </label></td><td><input type="text" name="name" /></td>
		</tr>
		<tr>
		<td><label for="number">Number:  </label></td><td><input type="text" name="number" /></td>
		</tr>
		<tr>
		<td><label for="section">Section:  </label></td><td><input type="text" name="section" size="60"/></td>
		</tr>
		<tr>
		<td><label for="crn">CRN:  </label></td><td><input type="text" name="crn" size="60"/></td>
		</tr>
		<tr><td></td>
		<td><input type="submit" name="submit" value="submit"/></td>
		</tr>
		</table>
		</form>
		
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>
