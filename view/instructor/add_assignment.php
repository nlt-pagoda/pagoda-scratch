<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($added)):
$this->RenderMsg("Assignment added!");
endif ?>

<div id=sidepanel>
	<h2>Controls</h2>
	<ul>
	<li><a href="<?php echo BASEPATH; ?>instructor/add/announcement/<?php echo $courseID;?>">Add Announcement</a></li>
	<li><a href="<?php echo BASEPATH; ?>instructor/add/assignment/<?php echo $courseID;?>">Add Assignment</a></li>
	<li><a href="<?php echo BASEPATH; ?>instructor/view/assignments/<?php echo $courseID;?>">View Assignments</a></li>
	</ul>
</div>

<h1>Instructor Control Panel</h1>

<h2>Add Assignment</h2>

<form action="" method="POST">
	<table>
		<tr>
			<td>
				<label for="title">Title:  </label>
			</td>
			<td>
				<input type="text" name="title" value='<?php if(isset($_SESSION['tmpCourseTitle'])) echo $_SESSION['tmpCourseTitle']; ?>'/>
			</td>
			</tr>
			<tr>
			<td>
				<label for"files">Attachment: </label>
			</td>
			<td>
			<?php
				if(isset($files))
				{
					foreach($files as $file)
					{
						echo basename($file)."</br>";
						echo "<input type='hidden' name='files2Buploaded[]' value='".$file."'/>";
					}
				}
			?>
			<a href="#" id="attachLink">Attach</a>
			</td>
			
		</tr>
	<!--  ADDED BY TRAVIS-->
			<tr>
			<td> <label for="rubrics"> Rubrics: </td><td></label>
				<select name="rubrics">
				<?php foreach($rubrics as $rubric)
				{
					echo "<option value='";
					echo $rubric["Rubric"]["RubricID"]."'>";
					echo $rubric["Rubric"]["name"]."</option>";
				}
				?>
				</select>
		</tr>
		<!--  ========================= -->
		<tr>
			<td>
				<label for="duedate">Due date:  </label>
			</td>
			<td>
				<input id="duedate" type="datetime" name="duedate" value="<?php if(isset($_SESSION['tmpDueDate'])) echo $_SESSION['tmpDueDate'];?>">
			</td>
		<tr>
			<td>
				<label for="assignment">Description:  </label>
			</td>
			<td>
				<textarea id="nicEdittextarea" rows="10" cols="90" name="text"> </textarea>
			</td>
			<tr>
			<td>
				<td>
					<input type="submit" name="assignHW" value="Submit"/>
				</td>
			</td>
			</tr>
		</tr>
	</table>
	
</form>

			<td>
				<form name="hidden_infos" method='POST' action="<?php echo BASEPATH.'upload/index/'.$id;?>">
					<input type='hidden' name='hidden_title'/>
					<input type='hidden' name='hidden_date'/>
					<input type='hidden' name='hidden_desc'/>
				</form>	
			</td>
<!-- start datetimePicker Plugin -->
<script type="text/javascript" src="<?php echo BASEPATH; ?>include/js/upload.js"></script>
<link type="text/css" href="<?php echo BASEPATH; ?>include/js/jui/css/ui-lightness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<link type="text/css" href="<?php echo BASEPATH; ?>include/css/timePicker.css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASEPATH; ?>include/js/jui/js/jui.js"></script>
<script type="text/javascript" src="<?php echo BASEPATH; ?>include/js/date_time/jdt.js"></script>
<script type="text/javascript">
	$(function(){

		// Datepicker
		$('#duedate').datetimepicker({
					showSecond: true,
					dateFormat: 'yy-mm-dd',
					timeFormat: 'hh:mm:ss',
					stepHour: 1,
					stepMinute: 1,
					stepSecond:1 
			});
	});
	$(document).ready(function(){
			var myInstance3 = new nicEditors.findEditor('nicEdittextarea');
			myInstance3.setContent("<?php if(isset($_SESSION['tmpCourseDesc'])) echo $_SESSION['tmpCourseDesc'];?>");
			$("#attachLink").click(function(){
				//Start populate all the data to the hidden text field
					$("[name=hidden_title]").val($("[name=title]").val());
					$("[name=hidden_date]").val($("[name=duedate]").val());
					//Initializing for getting the value of textarea
					var myInstance2 = new nicEditors.findEditor('nicEdittextarea');
					//-----------------------------------------------
					$("[name=hidden_desc]").val(myInstance2.getContent());
					console.log($("[name=hidden_desc]").val());
					$("[name=hidden_infos]").submit();
				//End populating the data
				//alert($("[name=hidden_title]").val());
				//alert($("[name=hidden_date]").val());
				//alert($("[name=hidden_desc]").val());
				});
			});
</script>
<!-- end datetimePicker Plugin -->
	<div id="tmpInfo">
</div>
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>