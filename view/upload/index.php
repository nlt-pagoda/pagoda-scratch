<script type="text/javascript" src="<?php echo BASEPATH; ?>include/js/upload.js"></script>
<div id="shout">
<?php if($display):?>
<form method='POST' enctype='multipart/form-data' action="">
		<ul id='parentFilelist'></ul>
		<a href='#' id='attacher'>Attach Files</a>
		<input type='submit' name='submit' id='submit' value='Upload'/>
	</form>
</div>
<div id="formBox">
<?php else: ?>
<b>Please login to continue</b>
<?php endif ?>
</div>
