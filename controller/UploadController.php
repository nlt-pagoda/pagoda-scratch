<?php
class UploadController extends Controller
{
	protected static $test;
	public function __construct($model,$controller,$action){
		parent::__construct($model,$controller,$action);
		global $session;
		//echo "constructor";
		if($session->isLoggedIn()){
			if(isset($_POST['submit']) || isset($_POST['replace']))
			{
				$test = new Upload();
				$test->defineDir($session->getName()); //Make directory based on the username
				$test->pushUpload(); //Call function pushupload inside Upload Model
				if(count(Upload::$errors)>0)
					self::uploadError();
				else{
				//print_r(Upload::$successFiles);
					self::$test = Upload::$successFiles;
					self::uploadSuccess();
					//header("Location:".BASEPATH."upload/uploadSuccess/");
				}
			}
			$this->set("display",true);
		}
		else
			$this->set("display",false);
	}



	public function uploadError(){
		//print_r(self::$test);
		$this->set("errors",Upload::$errors);
	}


	public function uploadSuccess($tmp){
		//$test = array("hello","world");
		//print_r(self::$test);
		if(!isset($tmp)){
			$this->set("uploadedFiles",Upload::$successFiles);
			$this->set("existingFiles",Upload::$existingFiles);
			header("Location:".BASEPATH."upload/uploadSuccess/true");
		}
	}
	//Don't think I will be needing this function
/*	public function countArray($array)
	{
		if(count($array)>0)
			return true;
		else
			return false;
	}
	*/
	/*public function displayInfo($data)
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
	*/
}
