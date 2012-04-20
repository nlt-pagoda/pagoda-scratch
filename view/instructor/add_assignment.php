<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($assigned)):
$this->RenderMsg("Assignment added!");
endif ?>

<h1>Instructor Control Panel</h1>

<h2>Add Assignment</h2>

<form action="" method="POST">
	<table>
		<tr>
			<td>
				<label for="title">Title:  </label>
			</td>
			<td>
				<input type="text" name="title" value='<?php echo $title; ?>'/>
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
						echo "<input type='hidden' name='files2Buploaded[]' value='".$file."'/></br>";
					}
				}
			?>
			</td>
		</tr>
				<tr>
			<td>
				<label for="duedate">Due date:  </label>
			</td>
			<td>
				<input id="duedate" type="datetime" name="duedate" value="">
			</td>
		<tr>
			<td>
				<label for="assignment">Description:  </label>
			</td>
			<td>
				<textarea id="nicEdittextarea" rows="10" cols="90" name="text" value='<?php echo $desc; ?>'></textarea>
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
				<form method='POST' action="<?php echo BASEPATH.'upload/index/'.$id;?>">
					<input type='hidden' name='title' value=""/>
					<input type='submit' name='attachFiles' value="Attach"/>
				</form>	
			</td>
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
</script>
	<div id="tmpInfo">
</div>
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>


