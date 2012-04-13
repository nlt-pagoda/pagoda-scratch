<?php
class UploadController extends Controller
{
	public function __construct($model,$controller,$action)
	{
		parent::__construct($model,$controller,$action);
		global $session;
		global $cId; //Global course id, this needs to be stored if a user is redirected to this page.
					// Stored when a user uploads some file because we're basically refreshing the page causing us to lose this data
					// So, a workaround would be assigning it in a hidden value along with the uploaded file
					// or passing it as a parameter.
		if($session->isLoggedIn())
		{
			$this->set("display",true);
			if(isset($_POST['upload']) || isset($_POST['replace']))
			{
				print_r($_FILES["docs"]["name"]);
				$test = new Upload();
				$test->defineDir($session->getName()); //Make directory based on the username
				$test->pushUpload(); //Call function pushupload inside Upload Model
				if(count(Upload::$errors)>0)
				{
					//Need to add error redirection
					print_r(self::uploadError());
				}
				else
				{
					//if(isset($_POST['replace']))
					$url = BASEPATH."upload";
					//else
					//{


					// Only done for testing purpose
					//$url = BASEPATH."upload/success/";
					//----------------------------------
					
					//Attaches the successfully uploaded files to the url
					if(isset(Upload::$successFiles))
					{
						$pendingSuccessFiles = serialize(Upload::$successFiles);
					}
						/*$pendingFiles = implode(';', array_map(function($key,$val){
									return 'file'.urlencode($key).'='.urlencode($val);
									},
									array_keys(Upload::$successFiles),Upload::$successFiles)
								);
						*/
					//Attaches the duplicate files to the url
					if(isset(Upload::$existingFiles)&& count(Upload::$existingFiles)>0)
					{
						$url = BASEPATH."upload/success/";
						$pendingReplaceFiles = serialize(Upload::$existingFiles);
					}
					?>
					<form id='spy' action='<?php echo $url; ?>' method="post">
						<input type="hidden" name="spyId" value="<?php echo $cId;?>"/>
						<input type="hidden" name="spySuccess" value="<?php echo htmlentities($pendingSuccessFiles,ENT_QUOTES);?>"/>
						<input type="hidden" name="spyReplace" value="<?php echo htmlentities($pendingReplaceFiles,ENT_QUOTES);
																		//htmlentities($var, ENT_QUOTES) strips off quotes making it possible to store in a variable
																		?>" /> 
					</form>

					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>"
					<script type="text/javascript">
						$(document).ready(function(){ $('#spy').submit(); });
					</script>
					<?php
				}
			}
		}
		else
			$this->set("display",false);
	}


	public function index()
	{
		global $session;
		$output = '';
		foreach(func_get_args() as $value)
			$output.=$value;
		if(!empty($courseId))
			$cId = $output;
		if(is_dir("uploads/".$session->getName()))
		{
			chdir("uploads/".$session->getName());
			$list = exec('dir/B/A:-D',$result);
		}
			$this->set("files",$result);
	}

	public function error(){
		$this->set("errors",Upload::$errors);
	}

	public function select_courses()
	{
		global $session;
		$userID = $session->getID();
		$this->set('courses',$this->Instructor->query("SELECT * FROM `Course` INNER JOIN User ON Course.InstructorID = User.UserID INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE User.UserID = $userID"));
	}



	public function success()
	{
		//$totalFiles = array();
		//$totalDuplicate = '';
		//$totalSuccess = $x;
		$pendingFilesCombined = '';
		$courseId = $_POST['spyId'];
		//$test = preg_match("/;replace;/",$_POST['replaceSpy']);
		?>
		<?php 
		if(isset($_POST['spySuccess']) || isset($_POST['spyReplace']))
		{ 
			//$pendingFilesCombinedSuccess= unserialize($test2[1]);
		//	$pendingFilesCombinedReplace = unserialize($_POST['spyReplace']);
		/*if(preg_match('/;replace;/',$x)){
			$totalFiles = explode(';replace;',$x);
			$totalSuccess = $totalFiles[0];
			$totalDuplicate = $totalFiles[1];
		}
		*/
		//$holderSuccess = array(); //Array for newly uploaded files
			$holderReplace = unserialize($_POST['spyReplace']); //Array for replacing files

			if(!empty($pendingFilesCombinedReplace))
			{
				//if($data = explode(';replace;',$pendingFilesCombined))//We currently don't need this right now 
																		// This is now handled by seperate textfield
																		// The ';replace;' is only placed in url if new files are added
																		// making it efficient
/*
				$count=0;
				foreach($holderSuccess as $d)
				{
						$l = explode('=',$d);
						if($l[0]=='file'.$count)
							array_push($holderSuccess,$l[1]);
						$count++;
					}
				}
				//$data2 = unserialize($totalDuplicate);
*/
				$count=0;
			/*	foreach($pendingFilesCombinedReplace as $d)
				{
					$l = explode('=',$d);
					if($l[0]=='file'.$count)
						array_push($holderReplace,$l[1]);
					$count++;
				}
				*/
			//$this->set("uploadedFiles",$holderSuccess);
			}
			$this->set("existingFiles",$holderReplace);
			$this->set("cId",$courseId);
		}
	}
}
