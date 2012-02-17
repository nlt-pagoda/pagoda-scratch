<?php
class Upload
{
	public static $existingFiles = array();
	public static $errors = array();
	public static $successFiles = array();
	public function makeDir($dir)
	{
		if(mkdir($dir))
			return true;
		else
			return false;
	}
	public function setDirs()
	{
		if(!is_dir("uploads"))	
		{
			if(Upload::makeDir("uploads")&&Upload::makeDir("uploads/username"))
				return true;
			else
				return false;
		}
		else if(!is_dir("uploads/username"))
		{
			if(Upload::makeDir("uploads/username"))
				return true;
			else
				return false;
		}
		else
			return true;
	}
	public function checkFiles($files)
	{
		$continuousCounter = 0;
		$existingFiles = array();
		while($continuousCounter<count($files))
		{
			if(file_exists("uploads/username/".$files[$continuousCounter]))
				Upload::setExistingFileInfo($continuousCounter);
			$continuousCounter++;
		}
		return $existingFiles;
	}
	public function pushUpload()
	{
		
		echo "<pre>";
		$copy = $_FILES;
		print_r($copy);
		echo "</pre>";
		if (Upload::setDirs())
		{
			$fileCheck = Upload::checkFiles($copy["docs"]["name"]); //Stores the already existing filename.
			foreach($_FILES["docs"]["error"] as $key =>$error)
			{
				switch($_FILES["docs"]["error"][$key])
				{
				case 0:
					if(!array_key_exists($_FILES["docs"]["name"][$key],$fileCheck)) //If the hash key is not found in fileCheck perform upload
					{
						move_uploaded_file($_FILES["docs"]["tmp_name"][$key], "uploads/username/".$_FILES["docs"]["name"][$key]);
						Upload::setUploadedFileInfo($key);
					}
					break;
				case 1:
					array_push(self::$errors,$_FILES["docs"]["name"][$key]);
					break;
				case 2:
					array_push(self::$errors,$_FILES["docs"]["name"][$key]);
					break;
				}
			}
		}
		else
			return false;
	}
	public function setExistingFileInfo($fileId)
	{
		self::$existingFiles["name"][$fileId]=$_FILES["docs"]["name"][$fileId];
		self::$existingFiles["oldFileSize"][$fileId]=fileSize("uploads/username/".$_FILES["docs"]["name"][$fileId]);
		self::$existingFiles["newFileSize"][$fileId]=$_FILES["docs"]["size"][$fileId];
	}
	public function setUploadedFileInfo($fileId)
	{
		array_push(self::$successFiles,$_FILES["docs"]["name"][$fileId]);
	}
	public function uploadStatus()
	{

	}
	public function getValidation()
	{
	}
}
?>
