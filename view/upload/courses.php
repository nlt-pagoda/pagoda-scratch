<div id="content">
<?php if($display):
	//var_dump($courses);
	//var_dump($files);
//	var_dump($role);
	if(isset($auto_assign))
	{
		$path='';
		if(count($files)<1)
		{

			$path = BASEPATH.'upload/index/'.$cID;
			?>
			<form name="attach_files" action="<?php echo $path; ?>" method = "post">
			<?php
			echo $path;
			$this->RenderMsg("Add some files first");
			?>
			<input type="submit" value="Attach" name="attach"/>
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
				echo $file."</br>";
			}
			?>
			<input type="submit" value="Attach" name="submitAttachFiles"/>
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
<?php else:
$this->RenderMsg("Please login to continue");
endif ?>
</div>

