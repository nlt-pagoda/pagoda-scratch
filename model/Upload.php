<?php
class Upload
{
	public static $existingFiles=array();
	public static $errors=array();
	public static $successFiles=array();
	private static $rootDir;
	private static $subDir;
	public function __construct()
	{
		session_start();
		self::$rootDir = "../../uploads/";
		$username = $_SESSION['username'];
		self::$subDir = "../../uploads/$username/";
		
	}
	public function makeDir($dir)
	{
		if(mkdir($dir))
			return true;
		else
			return false;
	}
	public function setDirs()
	{
		if(!is_dir(self::$rootDir))	
		{
			if(Upload::makeDir(self::$rootDir)&&Upload::makeDir(self::$subDir))
				return true;
			else
				return false;
		}
		else if(!is_dir(self::$subDir))
		{
			if(Upload::makeDir(self::$subDir))
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
			if(file_exists(self::$subDir.$files[$continuousCounter]))
				Upload::setExistingFileInfo($continuousCounter);
			$continuousCounter++;
		}
		return $existingFiles;
	}
	public function uploadConfirm()
	{
		if (array_key_exists("name",self::$existingFiles))
		{
			foreach($_FILES["docs"]["error"] as $key=>$error)
			{
				switch($_FILES["docs"]["error"][$key])
				{
				case 0:
					if(!in_array($_FILES["docs"]["name"][$key],self::$existingFiles["name"])) //If the hash key is not found in fileCheck perform upload
					{
						move_uploaded_file($_FILES["docs"]["tmp_name"][$key], self::$subDir.$_FILES["docs"]["name"][$key]);
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
		{

			foreach($_FILES["docs"]["error"] as $key=>$error)
			{
				switch($_FILES["docs"]["error"][$key])
				{
				case 0:
				{
					move_uploaded_file($_FILES["docs"]["tmp_name"][$key], self::$subDir.$_FILES["docs"]["name"][$key]);
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
	}
	public function pushUpload()
	{
		if (Upload::setDirs())
		{
			if(!isset($_POST['setReplace']))
			{
				Upload::checkFiles($_FILES["docs"]["name"]); //Stores the already existing filename.
			}
			else
			{
				print_r($_POST['setReplace']);
				foreach($_POST['setReplace'] as $upload)
				{
					
					echo $upload;
				}
			}
			Upload::uploadConfirm();
		}
		else
			return false;
	}
	public function setExistingFileInfo($fileId)
	{
		//Populates the class array $existingFiles with their old file size and the size of file that's being replaced
		self::$existingFiles["name"][$fileId]=$_FILES["docs"]["name"][$fileId];
		//Old file size
		self::$existingFiles["oldFileSize"][$fileId]=fileSize(self::$subDir.$_FILES["docs"]["name"][$fileId]);
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
