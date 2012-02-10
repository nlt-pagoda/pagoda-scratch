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
		
		public function success($rolesid)
		{
		echo("<div id=\"messages\">");
		echo("You logged in<br/>");
				
				
				if ($rolesid == 1)
				{
					echo("Welcome Administrator!");
				}
				
				else if ($rolesid == 2)
				{ 
					echo("Welcome Student of MSU!");
				}
				
				else if ($rolesid == 3)
				{ 
					echo("Welcome Instructor of MSU!");
				}
				
				else if ($rolesid == 4)
				{ 
					echo("Welcome Accreditor of MSU!");
				}
								
		echo("</div>");	
		}
		
		public function RenderFooter()
		{
			require ('view/footer.php');
			
		}
		
	}

?>