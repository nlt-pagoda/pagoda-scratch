<script type="text/javascript" src="<?php echo BASEPATH; ?>include/js/upload.js"></script>
<div id="content">
<?php if($display):?>
<div id="files">
<!-- Selectable files  -->
<?php
if($cId=='')
	$redirect = BASEPATH."upload/courses";
else
	$redirect = BASEPATH."upload/courses/".$cId;
?>

<?php
	if(count($files))
	{
?>
<form name="selectFile" action='<?php echo $redirect; ?>' method='post'> 
	<div id="fileTable">
			<ul id="ls">
			<?php
			foreach($files as $file)
			{
			?>
				<li>
					<div id="files"> 
						<?php echo $file ?> <input type="checkbox" name="ls[]" value="<?php echo BASEPATH."uploads/".$file ?>"/>
					</div> 
				</li>
			<?php
			}
			?>
			</ul>

	</div>
<input type="submit" name="add" value ="Assign"/>
</form>
<?php
}
else
	$this->RenderMsg("No files uploaded yet!!!");
?>
<form name "attachFiles" method='POST' enctype='multipart/form-data' action="">
	<a href='#' id='attacher'>Upload Files</a>
	<ul id='parentFilelist'></ul>
	<input type='submit' name='upload' id='upload' value='Upload'/>
</form>
</div>
</div>
<div id="formBox">
<?php else:
$this->RenderMsg("Please login to continue");
endif ?>
</div>
