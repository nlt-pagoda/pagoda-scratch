<?php
require_once("../../model/Upload.php");
class UploadController 
{
	public function submitUpload()
	{
		$test = new Upload();
		$test->pushUpload();
		if(count($test::$errors)>0)
		{	
			echo "<div id='errorBox'>
			<div id='errorTitle'>
			Errors:
			</div>";
		}
		UploadController::getInfo($test::$errors);
		echo "</div>";
		if(count($test::$existingFiles>0))
		{
			echo "<div id='replaceBox'>
				<div id='replaceTitle'>
				Overwrite? :
				</div>";
		}
		UploadController::getInfo(Upload::$existingFiles['name']);
		echo "</div>";
		if(count($test::$successFiles)>0)
		{
			echo "<div id='successBox'>
			<div id='successTitle'>
			Successfully Uploaded :
			</div>";
		}
		UploadController::getInfo($test::$successFiles);
		echo "</div>";


	}
	public function countArray($array)
	{
		if(count($array)>0)
			return true;
		else
			return false;
	}
	public function getInfo($data)
	{
		foreach($data as $display)
		{
			echo "<div id='msgBox'>";
			echo $display;
			echo "</div>";

		}
	}
}
