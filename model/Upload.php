<?php
session_start();
class Upload
{
	public static $existingFiles = array();
	public static $errors = array();
	public static $successFiles = array();
	const rootDir = "../../uploads/"; //Currently chosen uploads as a directory name, can change in future
	const subDir = "../../uploads/username/";
	public function makeDir($dir)
	{
		if(mkdir($dir))
			return true;
		else
			return false;
	}
	public function setDirs()
	{
		if(!is_dir(self::rootDir))	
		{
			if(Upload::makeDir(self::rootDir)&&Upload::makeDir(self::subDir))
				return true;
			else
				return false;
		}
		else if(!is_dir(self::subDir))
		{
			if(Upload::makeDir(self::subDir))
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
			if(file_exists(self::subDir.$files[$continuousCounter]))
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
						move_uploaded_file($_FILES["docs"]["tmp_name"][$key], self::subDir.$_FILES["docs"]["name"][$key]);
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
		//Populates the class array $existingFiles with their old file size and the size of file that's being replaced
		self::$existingFiles["name"][$fileId]=$_FILES["docs"]["name"][$fileId];
		//Old file size
		self::$existingFiles["oldFileSize"][$fileId]=fileSize(self::subDir.$_FILES["docs"]["name"][$fileId]);
		//New file size
		self::$existingFiles["newFileSize"][$fileId]=$_FILES["docs"]["size"][$fileId];
	}
	public function setUploadedFileInfo($fileId)
	{
		//Populates the class array $successFiles with the successfully uploaded files
		array_push(self::$successFiles,$_FILES["docs"]["name"][$fileId]);
	}
	public function uploadStatus()
	{
		//Possible future expansion
	}
	public function getValidation()
	{
		//Add codes if files need to be validated
	}
}
?>
