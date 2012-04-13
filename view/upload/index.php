<script type="text/javascript" src="<?php echo BASEPATH; ?>include/js/upload.js"></script>
<div id="content">
<?php if($display):?>
<div id="files">
<!-- Selectable files  -->
<form name="selectFile" action='' method='post'> 
	<?php
	foreach($files as $file)
	{
	?>
		<div id="files"> <?php echo $file ?>
		<input type="checkbox" name="<?php echo $file ?>"/> </div> 
	<?php
	}
?>
</form>
</div>
<form method='POST' enctype='multipart/form-data' action="">
		<ul id='parentFilelist'></ul>
		<a href='#' id='attacher'>Attach Files</a>
		<input type='submit' name='upload' id='upload' value='Upload'/>
	</form>
</div>
<div id="formBox">
<?php else:
$this->RenderMsg("Please login to continue");
endif ?>
</div>
