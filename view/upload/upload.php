<html>
<?php
/*
function call_me()
{
	echo "test call me";
}
 */
require_once("Upload.php");
if(isset($_POST['submit']))
{
		Upload::pushUpload();
		print_r(Upload::$existingFiles);
		echo "<br/>";
		print_r(Upload::$errors);
		echo "<br/>";
		print_r(Upload::$successFiles);
}
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function removeFileList(fileId)
{
	var fileObj = document.getElementById(fileId);
	fileObj.parentNode.removeChild(fileObj);
}

$(document).ready(function(){
	var attacher= new Array();
	var fileCounter = 0;
	//The following function generates codes for input type file to be automatically added after Attach files link is clicked.
	function 
	$('#attacher').click(function(){
		var li = document.createElement('li');
		li.setAttribute('id','file'+fileCounter);
		li.innerHTML = '<input type="file" name="docs[]" id="docs'+fileCounter+'"/> <a href="#" onClick="removeFileList(\'file'+fileCounter+'\')">Remove</a>';
		document.getElementById('parentFilelist').appendChild(li);
		//$('#docs'+fileCounter).click();
		$('#docs'+fileCounter).trigger('click');
		fileCounter++;
	});
	
});
</script>
<body>
<div id="shout">
	<form method='POST' enctype='multipart/form-data' action="<?php $_SERVER['PHP_SELF'];?>">
		<ul id='parentFilelist'></ul>
		<a href='#' id='attacher'>Attach Files</a>
		<input type='submit' name='submit' id='submit' value='Upload'/>
	</form>
</div>
<div id="formBox">
</div>
</body>
</html>
