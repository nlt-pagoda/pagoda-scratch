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
		$cId='';
		if($session->isLoggedIn())
		{
			$this->set("display",true);
			if(isset($_POST['upload']) || isset($_POST['replace']))
			{
				$test = new Upload();
				$test->defineDir($session->getName()); //Make directory based on the username
				$test->pushUpload(); //Call function pushupload inside Upload Model
				if(count(Upload::$errors)>0)
				{
					//Need to add error redirection
					print_r(Upload::uploadError());
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
						<input type="hidden" name="spySuccess" value="<?php if(isset($pendingSuccessFiles)) echo htmlentities($pendingSuccessFiles,ENT_QUOTES);?>"/>
						<input type="hidden" name="spyReplace" value="<?php if(isset($pendingReplaceFiles)) echo htmlentities($pendingReplaceFiles,ENT_QUOTES);
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


	public function index($course="null")
	{
		global $session;
		global $cId;
		//$output = '';
		//foreach(func_get_args() as $value)
		//	$output.=$value;
		if(isset($_POST['hidden_title']))
			$_SESSION['tmpCourseTitle'] = $_POST['hidden_title'];
		if(isset($_POST['hidden_date']))
			$_SESSION['tmpDueDate'] = $_POST['hidden_date'];
		if(isset($_POST['hidden_desc']))
			$_SESSION['tmpCourseDesc'] = $_POST['hidden_desc'];

		//Store the courseID....THIS IS IMPORTANT!!! COURSEID MUST STAY BE PASSED AMONG ALL THE PAGES 
		if($course!="null")
		{
			$cId = $course;
		}
		else
		{
			$cId = '';
		}
		//---------------------------------------------------------------------------------------------

		//Checks the users document and display them
		if(is_dir("uploads/".$session->getName()))
		{
			chdir("uploads/".$session->getName());
			$list = exec('dir/B/A:-D',$result); //executes the command and stores it in the second parameter $result
			$this->set("files",$result);
			$this->set("cId",$cId);
		}
		//-----------------------------------------------------------------------------------------------------------
		else
		{
			$this->set("cId",$cId);
			$this->set("files",null);
		}
	}

	public function error(){
		$this->set("errors",Upload::$errors);
	}

	public function courses($courseId = "null")
	{

		global $session;
		$userID = $session->getID();
		//Trying to find the role of the user to perform the query accordingly//
		$roleIDQuery = mysql_query("SELECT `User_has_Roles`.`RolesID` FROM `User_has_Roles` where `User_has_Roles`.`UserID` = $userID ");
		$roleID = mysql_fetch_array($roleIDQuery,MYSQL_ASSOC); 
		$roleID = intval($roleID['RolesID']);
		$roleQuery = mysql_query("SELECT `Roles`.`role` FROM `Roles` where `Roles`.`RolesID` = $roleID");
		//===================================================================================//
		$role = mysql_fetch_array($roleQuery,MYSQL_ASSOC);
		if(isset($_POST['course']))
			$courseId = $_POST['course'];
		if($courseId == "null")
		{
			if($role['role'] == "Instructor")

				$query = mysql_query("SELECT `Course`.`CourseID`,`Course`.`CRN`, `Course`.`name`, `Course`.`section`, `Course`.`number` FROM `Course` INNER JOIN User ON Course.InstructorID = User.UserID INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE User.UserID = $userID");
			else if($role['role'] == "Student")
				$query = mysql_query("SELECT `Course`.`CourseID`, `Course`.`CRN`, `Course`.`name`, `Course`.`section`, `Course`.`number` FROM Course INNER JOIN Course_has_Students ON Course.CourseID = Course_has_Students.CourseID INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE Course_has_Students.StudentID = $userID");

			$i = 0;
			while($row[$i++] = mysql_fetch_array($query,MYSQL_ASSOC)) //looping through query and putting it in an array
			$this->set('courses',$row);
			//$this->set('cIds',mysql_query("SELECT CourseID From `Course` INNER JOIN Department ON Course.DepartmentID = Department.DepartmentID WHERE User.UserID = $userID"));
			if(isset($_POST['ls']))
				$this->set('files',$_POST['ls']);
			if(isset($role))
				$this->set('role',$role);

		}
		else
		{
			$this->set('tmpUser',$userID);
			$this->set('cID',$courseId);
			if(isset($_POST['ls']))
				$this->set('files',$_POST['ls']);
			else
				$this->set('files',null);
			$this->set('role',$role);
			$this->set('auto_assign',true);
		}
	}



	public function success()
	{
		//$totalFiles = array();
		//$totalDuplicate = '';
		//$totalSuccess = $x;
		$pendingFilesCombined = '';
		if(isset($_POST['spyId']))
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
			if(isset($courseId))
				$this->set("cId",$courseId);
		}
	}
}
