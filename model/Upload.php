<?php
class Upload extends Model
{
	public static $existingFiles=array();
	public static $errors=array();
	public static $successFiles=array();
	private static $rootDir;
	private static $subDir;
	private static $tmpSubDir;


//Sets the master path, path for user and a temporary path.
	public function defineDir($dirName){
		self::$rootDir = "uploads/"; //This path needs to be changed, temp path chosen for now
		self::$subDir = "uploads/$dirName/";
		self::$tmpSubDir = "uploads/$dirName/tmp/";
		//array_push(self::$successFiles,"hey.txt");
		//array_push(self::$successFiles,"hey.txt");
	}


// This actually creates directory based on the parameter passed
// Returns true if success, false if not.
	public function makeDir($dir){
		if(mkdir($dir))
			return true;
		else
			return false;
	}



//Checks whether the directory has already been created before
//and creates it if not, If all the directories were already created then returns true.
	public function setDirs(){
		if(!is_dir(self::$rootDir)){
			if(Upload::makeDir(self::$rootDir)&&Upload::makeDir(self::$subDir))
				return true;
			else
				return false;
		}
		else if(!is_dir(self::$subDir)){
			if(Upload::makeDir(self::$subDir))
				return true;
			else
				return false;
		}
		else if(!is_dir(self::$tmpSubDir)){
			if(Upload::makeDir(self::$tmpSubDir))
				return true;
			else
				return false;
		}
		else
			return true;
	}


// Checks if the file already exist with the same name
// Calls setExistingFileInfo() functions if a match is found
	public function checkFiles($files){
		$continuousCounter = 0;
		while($continuousCounter<count($files)){
			if(file_exists(self::$subDir.$files[$continuousCounter]))
				Upload::setExistingFileInfo($continuousCounter);
			$continuousCounter++;
		}
	}



//This does the main upload task of the files
	public function uploadConfirm(){
		if(array_key_exists("name",self::$existingFiles)){
			foreach($_FILES["docs"]["error"] as $key=>$error){
					switch($_FILES["docs"]["error"][$key]){
					case 0:
						//If the hash key is not found in fileCheck perform upload
						if(!in_array($_FILES["docs"]["name"][$key],self::$existingFiles["name"])){
							move_uploaded_file($_FILES["docs"]["tmp_name"][$key], self::$subDir.$_FILES["docs"]["name"][$key]);
							Upload::setUploadedFileInfo($key);
						}
						else
							move_uploaded_file($_FILES["docs"]["tmp_name"][$key], self::$tmpSubDir.$_FILES["docs"]["name"][$key]);
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
		else{
			foreach($_FILES["docs"]["error"] as $key=>$error){
				switch($_FILES["docs"]["error"][$key]){
				case 0:{
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


//Delete temporary directories and fles
	public function destroyAll($dir){
		$tmpDir = opendir($dir);
		while(false!==($file=readdir($tmpDir))){
			if($file!="." && $file!=".."){
				chmod($dir.$file, 0777);
				unlink($dir.$file) or die("Failed removing temporary file");
			}
		}
		closedir($tmpDir);
		rmdir($dir);
	}


//Semi main function that uploads the physical file
	public function pushUpload(){
		if (Upload::setDirs()){ //Check the necessary directories needed to be created
			//Do not create tmp directory if setReplace variable is not set
			if(!isset($_POST['replace'])){
				if(is_dir(self::$tmpSubDir))
					Upload::destroyAll(self::$tmpSubDir); //Remove the previously created temporary directory if exists 

				Upload::checkFiles($_FILES["docs"]["name"]); //Stores the already existing filename.
				Upload::setDirs();
				Upload::uploadConfirm();
			}
			else{
				$lsTmp = scandir(self::$tmpSubDir);
				foreach($_POST['setReplace'] as $tmpReplace){
					if(in_array($tmpReplace,$lsTmp)) //checks the array $tmpReplace with the array that has duplicate filesname stored in it
						copy(self::$tmpSubDir.$tmpReplace,self::$subDir.$tmpReplace); //Replace the original one with the new file		
				}
				Upload::destroyAll(self::$tmpSubDir);
			}
		}
		else
			return false;
	}



//Makes an array that has information of duplicate files.
	//Informations are name, original fileSize with the new fileSize
	public static function setExistingFileInfo($fileId){
		static $smartCounter = 0;
		//Populates the class array $existingFiles with their old file size and the size of file that's being replaced
		self::$existingFiles["name"][$smartCounter]=$_FILES["docs"]["name"][$fileId];
		//Old file size
		self::$existingFiles["oldFileSize"][$smartCounter]=fileSize(self::$subDir.$_FILES["docs"]["name"][$fileId]);
		//New file size
		self::$existingFiles["newFileSize"][$smartCounter]=$_FILES["docs"]["size"][$fileId];
		$smartCounter++;
	}

//Creates an array of fileName that has been successfully uploaded
	public function setUploadedFileInfo($fileId){
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
