<?php
class UploadController extends Controller
{
	public function __construct($model,$controller,$action){
		parent::__construct($model,$controller,$action);
		global $session;
		if($session->isLoggedIn()){
			$this->set("display",true);
			if(isset($_POST['submit']) || isset($_POST['replace']))
			{
				if(isset($_POST['replace']))
					print_r($_POST['setReplace']);
				$test = new Upload();
				$test->defineDir($session->getName()); //Make directory based on the username
				$test->pushUpload(); //Call function pushupload inside Upload Model
				if(count(Upload::$errors)>0){
					//Need to add error redirection
					print_r(self::uploadError());
				}
				else{
					if(isset($_POST['replace']))
						$url = BASEPATH."upload/";
					else
						$url = BASEPATH."upload/success/";

					//Attaches the successfully files to the url
					if(isset(Upload::$successFiles))
						$url .= implode(';', array_map(function($key,$val){
									return 'file'.urlencode($key).'='.urlencode($val);
									},
									array_keys(Upload::$successFiles),Upload::$successFiles)
								);
					//Attaches the duplicate files to the url
					if(isset(Upload::$existingFiles)&& count(Upload::$existingFiles)>0){
						$he2 = serialize(Upload::$existingFiles);
						$url .= ";replace;";
						$url .= $he2;
					}
						
					header("Location:".$url);
				}
			}
		}
		else
			$this->set("display",false);
	}



	public function error(){
		$this->set("errors",Upload::$errors);
	}


	public function success($x){
		$totalFiles = array();
		$totalDuplicate = '';
		$totalSuccess = $x;
		$test = preg_match("/;replace;/",$x);
		$test2 = trim($x,";replace;");
		if(preg_match('/;replace;/',$x)){
			$totalFiles = explode(';replace;',$x);
			$totalSuccess = $totalFiles[0];
			$totalDuplicate = $totalFiles[1];
		}
		if(!empty($totalSuccess))
			$data = explode(';',$totalSuccess);
		$data2 = unserialize($totalDuplicate);
		$holder = array();
		if(isset($data)){
			$count=0;
			foreach($data as $d){
				$l = explode('=',$d);
				if($l[0]=='file'.$count)
					array_push($holder,$l[1]);
				$count++;
			}
		}
		$this->set("uploadedFiles",$holder);
		$this->set("existingFiles",$data2);
	}
}
