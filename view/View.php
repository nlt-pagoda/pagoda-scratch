<?php

	class View {
		
		function __construct() 
		{			
		}
		
		public function render($url)
		{
		
			$controller = $url[0];
			if (isset($url[1]))
				$action = $url[1];
			else 
				$action = "";
			if (isset($url[2]))
				$query = array_slice($url,2,count($url));
			else 
				$query = array("");
			
			if (file_exists("./controller/$controller.php"))
			{
				require "controller/$controller.php";
			}
			else
			{
				require('view/html/404.html');
			}
		}
		
		public function RenderMsg($msg)
		{
			echo("<div id=\"messages\">");
			echo $msg;
			echo("</div>");
			//echo "<p><a href=\"$_SERVER[PHP_SELF]\">Go back</a></p>";
			
		}
		
		public function RenderHeader()
		{
			require ('view/header.php');
		}
		
		public function RenderNavBar()
		{
			require ('view/navigation.php');
		}
		
			
		public function RenderFooter()
		{
			require ('view/footer.php');
			
		}
		
		public function SetCSS()
		{
			global $session;
		
			$CSSLink = '<link rel="stylesheet" type="text/css" href="';
			$neutralColors = "view/css/neutralColors.css\" />";
			$adminColors = "view/css/adminColors.css\" />";
			$studentColors = "view/css/studentColors.css\" />";
			$instructorColors = "view/css/instructorColors.css\" />";
			$accreditorColors = "view/css/accreditorColors.css\" />";
	
			if(!$session->isLoggedIn())
			{
				echo($CSSLink.BASEPATH.$neutralColors);	
			}
			
			else
			{
				$role = $session->getRole();
			
				if($role=='Administrator')
				{
					echo($CSSLink.BASEPATH.$adminColors);	
				}
				
				if($role=='Student')
				{
					echo($CSSLink.BASEPATH.$studentColors);	
				}
				
			
				if($role=='Instructor')
				{
					echo($CSSLink.BASEPATH.$instructorColors);	
				}
				
				if($role=='Accreditor')
				{
					echo($CSSLink.BASEPATH.$accreditorColors);	
				}
			}
		}
	}//end of class			
		
	
?>