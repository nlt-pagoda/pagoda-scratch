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
				$test = new Upload();
				$test->defineDir($session->getName()); //Make directory based on the username
				$test->pushUpload(); //Call function pushupload inside Upload Model
				if(count(Upload::$errors)>0)
					print_r(self::uploadError());
				else{
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
				}
			}
		}
		else
			$this->set("display",false);
	}



	public function uploadError(){
		$this->set("errors",Upload::$errors);
	}


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
		}
		$this->set("uploadedFiles",$holder);
	}
}
