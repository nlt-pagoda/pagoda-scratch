<?php
class UploadController extends Controller
{
	public function __construct($model,$controller,$action){
		parent::__construct($model,$controller,$action);
		global $session;
<<<<<<< HEAD
		//echo "constructor";
=======
>>>>>>> origin/HEAD
		if($session->isLoggedIn()){
			$this->set("display",true);
			if(isset($_POST['submit']) || isset($_POST['replace']))
			{
				$test = new Upload();
				$test->defineDir($session->getName()); //Make directory based on the username
				$test->pushUpload(); //Call function pushupload inside Upload Model
				if(count(Upload::$errors)>0)
					print_r(self::uploadError());
				else{
<<<<<<< HEAD
				//print_r(Upload::$successFiles);
					self::$test = Upload::$successFiles;
					self::uploadSuccess();
					//header("Location:".BASEPATH."upload/uploadSuccess/");
=======
					$url = BASEPATH."upload/uploadSuccess/";
					//$data = implode('%',Upload::$existingFiles);
					//$he2 = serialize(Upload::$existingFiles);
					//Attaches the successfully files to the url
					if(isset(Upload::$successFiles))
						$url .= implode(';', array_map(function($key,$val){
									return 'file'.urlencode($key).'='.urlencode($val);
									},
									array_keys(Upload::$successFiles),Upload::$successFiles)
								);
					//Attaches the duplicate files to the url
	/*				if(isset(Upload::$existingFiles))
						$url .= $he2;
						*/
					header("Location:".$url);
>>>>>>> origin/HEAD
				}
			}
		}
		else
			$this->set("display",false);
	}



	public function uploadError(){
<<<<<<< HEAD
		//print_r(self::$test);
=======
>>>>>>> origin/HEAD
		$this->set("errors",Upload::$errors);
	}


<<<<<<< HEAD
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

=======
	public function uploadSuccess($x){
		$data = explode(';',$x);
		$holder = array();
		if(isset($data)){
			$count=0;
			foreach($data as $d){
				$l = explode('=',$d);
				if($l[0]=='file'.$count)
					array_push($holder,$l[1]);
				$count++;
			}
>>>>>>> origin/HEAD
		}
		$this->set("uploadedFiles",$holder);
	}
}
