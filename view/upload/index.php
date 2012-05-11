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

<form name "attachFiles" method='POST' enctype='multipart/form-data' action="">
<table width="440" border="0">
	<tr>
		<td><a href='#' id='attacher'>Upload Files</a></td>
		<ul id='parentFilelist'></ul>
		<td align="center"><input type='submit' name='upload' id='upload' value='Upload'/></td>
	</tr>
</table>
</form>
<hr align="left" width="50%">
<?php
global $session;
	if(count($files))
	{
?>

<form name="selectFile" action='<?php echo $redirect; ?>' method='post'> 
	<div id="fileTable">
		<table border="0">
			<ul id="ls">
			<?php
			foreach($files as $file)
			{
			?>
				<tr>
					<div id="files"> 
						<td><li><?php echo $file ?></li></td> <td><input type="checkbox" name="ls[]" value="<?php echo "uploads/".$session->getName()."/".$file; //echo BASEPATH."uploads/".$session->getName()."/".$file; ?>"/></td>
					</div> 
				</tr>
			<?php
			}
			?>
			</ul>

		<tr>
		<td></td>
		<td align="center"><input type="submit" name="add" value ="Assign"/></td>
		</tr>
		</table>

	</div>
</form>
<?php
}
else
	$this->RenderMsg("No files uploaded yet!!!");
?>
</div>
</div>
<div id="formBox">
<?php else:
$this->RenderMsg("Please login to continue");
endif ?>
</div>
