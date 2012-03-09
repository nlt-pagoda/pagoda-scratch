<?php
//require_once("../../model/Upload.php");
class UploadController extends Controller
{
	public function __construct($model,$controller,$action)
	{
		parent::__construct($model,$controller,$action);
		global $session;
		if($session->isLoggedIn())
			$this->set("display",true);
		else
			$this->set("display",false);
	}

	public function uploadShow()
	{
			$test = new Upload();
			$test->defineDir($session->getName()); //Make directory based on the username
			$test->pushUpload(); //Call function pushupload inside Upload Model
			self::uploadError();
			self::uploadSuccess();
	}
	public function uploadError()
	{
		if(count(Upload::$errors)>0)
		{	
			echo "<div id='errorbox'>
			<div id='errortitle'>
			errors:
			</div>";
		}
		if(UploadController::getinfo(Upload::$errors))
		{
			return true;
		}
		else
			return false;
		echo "</div>";
	}
	public function uploadSuccess()
	{
		if(array_key_exists("name",Upload::$existingFiles))
		{
		echo "<div id='replacebox'>
				<div id='replacetitle'>
				do you want to overwrite these files? :
				</div>";
			UploadController::displayinfo(Upload::$existingFiles);
		}
		echo "</div>";
		if(count(Upload::$successFiles)>0)
		{
			echo "<div id='successbox'>
			<div id='successtitle'>
			successfully uploaded :
			</div>";
			UploadController::getinfo(Upload::$successFiles);
		}
		echo "</div>";
	}
	public function countArray($array)
	{
		if(count($array)>0)
			return true;
		else
			return false;
	}
	public function displayInfo($data)
	{
		$counter = 0;
		//print_r($data);
		echo "<form name='replaceBox' action='' method ='POST'>";
		while($counter<count($data['name']))
		{
		//	echo $counter;
			echo "{$data['name'][$counter]} of ".floor($data['oldFileSize'][$counter]/2048)." KB with ".floor($data['newFileSize'][$counter]/2048)." KB <input type='checkbox' name='setReplace[]' value='{$data['name'][$counter]}'/><br/>";
		       $counter++;	
		}
	//	echo "<a href='' onClick='".$riskyArray=."getChkboxValidation({$counter})'>Replace</a>";
		echo "<input type='submit' value='Replace' name='replace'/>";

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
