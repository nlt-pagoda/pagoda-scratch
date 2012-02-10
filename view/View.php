<?php

	class View {
		
		function __construct() 
		{
			
			
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
		
		public function success($rolesid)
		{
		echo("<div id=\"messages\">");
		echo("You logged in<br/>");
				
				
				if ($rolesid == 1)
				{
					echo("welcome Administrator!");
				}
				
				else if ($rolesid == 2)
				{ 
					echo("welcome Student of MSU!");
				}
				
				else if ($rolesid == 3)
				{ 
					echo("welcome Instructor of MSU!");
				}
				
				else if ($rolesid == 4)
				{ 
					echo("welcome Accreditor of MSU!");
				}
								
		echo("</div>");	
		}
		
		public function RenderFooter()
		{
			
			
		}
		
	}

?>