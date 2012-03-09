<html>
<<<<<<< HEAD
=======
<?php
if(isset($_POST['submit'])||isset($_POST['replace']))
		{
			UploadController::submitUpload();
		}
if (isset($notLoggedIn))
	$this->RenderMsg("Please login to continue.");
?>
>>>>>>> e1bddec1325685f4be2e73349ca35ba3d5964fe2
<script type="text/javascript" src="<?php echo BASEPATH; ?>include/js/upload.js"></script>
<body>
<div id="shout">
<form method='POST' enctype='multipart/form-data' action="">
		<ul id='parentFilelist'></ul>
		<a href='#' id='attacher'>Attach Files</a>
		<input type='submit' name='submit' id='submit' value='Upload'/>
	</form>
</div>
<div id="formBox">
</div>
</body>
</html>
