<?php

	class View {
		
		function __construct() 
		{
			
			
		}
		
		public function RenderMsg($msg)
		{
			echo $msg;
			//echo "<p><a href=\"$_SERVER[PHP_SELF]\">Go back</a></p>";
			
		}
		
		
		public function RenderHeader()
		{
			require ('view/header.php');
		}
		
		public function success($rolesid)
		{
		echo("You logged in<br/>");
				
				
				if ($rolesid == 1)
				{
					echo("welcome Administrator!");
				}
				
				else if ($rolesid == 2)
				{ 
					echo("welcome Student of MSU!");
				}
				
				else 
				{
					echo("welcome creature of another planet!");
				}
		}
		
		public function RenderFooter()
		{
			
			
		}
		
	}

?>