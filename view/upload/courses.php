<div id="content">
<?php if($display):
if(!isset($files)):
	$this->RenderMsg("No files selected to perform attachment. Please go back to the upload page and select file(s)");
else:
	if(isset($auto_assign))
	{
		echo "<p> Are you sure you want to add the following file(s)? </p>";
		$path='';
		if(count($files)<1)
		{

			$path = BASEPATH.'upload/index/'.$cID;
			?>
			<form name="attach_files" action="<?php echo $path; ?>" method = "post">
			<?php
			echo basename($path)."</br>";
			$this->RenderMsg("Add some files first");
			?>
			<input type="submit" value="Yes" name="attach"/>
			</form>
			<?php
		}
		else
		{
			$path = BASEPATH.strtolower($role['role']).'/add/assignment/'.$cID; 
			?>
			<form name="attach_files" action="<?php echo $path; ?>" method = "post">
			<?php
			foreach($files as $file)
			{
				echo "<input type='hidden' name='UattachFiles[]' value ='$file'/>";
				echo basename($file)."</br>";
			}
			?>
			<input type="submit" value="Yes" name="submitAttachFiles"/>
			<input type="button" value="No" name="redirect2Upload" id="redirect2Upload"/>
			</form>
			<?php
		}
	}
	else
	{
	?>
		<form name="courseSelect" method="post" action="<?php echo BASEPATH.'upload/courses'?>">
		<?php
		foreach($files as $file)
		{
			echo "<input type='hidden' name='ls[]' value ='".$file."'/>";
		}
		foreach($courses as $course)
		{
			echo $course['name']." ".$course['section']." ".$course['number'].
				"<input type='radio' name='course' value='".$course['CourseID']."'/>".
				"<br/>";
		}
		
		?>
		<input type="submit" name="attach" value ="Attach"/>
		</form>
		<?php
	}
	?>
<?php
endif;
else:
$this->RenderMsg("Please login to continue");
endif ?>
<script>
$(document).ready(function(){
			$("#redirect2Upload").click(function(){
				$(window.location).attr('href',"<?php echo BASEPATH.'upload' ?>");
		});
	});
</script>
</div>

