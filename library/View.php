<?php

	class View {
		
		protected $variables = array();
		protected $_controller;
		protected $_action;
		
		
		function __construct($controller,$action) 
		{			
			$this->_controller = $controller;
			$this->_action = $action;
		}
		
		//sets variables
		function set($name,$value)
		{
			$this->variables[$name] = $value;
		}
		
		//the whole template is rendered here!
		//you may be unfamiliar with what extract() does.
		//it takes an $array[key] = value
		//and converts it to a format like $key = value.
		//also, you can specifiy custom headers & footers
		//if /view/CONTROLLERNAME/header.php (or footer.php) exists!
		public function render()
		{
			extract($this->variables);
			//header
			if(file_exists(ROOT."view/".$this->_controller."/header.php"))
				include(ROOT."view/".$this->_controller."/header.php");
			else
				include(ROOT."view/header.php");
			
			//navbar
			if(file_exists(ROOT."view/".$this->_controller."/navigation.php"))
				include(ROOT."view/".$this->_controller."/navigation.php");
			else
				include(ROOT."view/navigation.php");
			//login (do we need this here?)
			require (ROOT."controller/login.php");
			
			
			//view
			if(file_exists(ROOT."view/".$this->_controller."/".$this->_action.".php"))
				include(ROOT."view/".$this->_controller."/".$this->_action.".php");
			else if(file_exists(ROOT."view/".$this->_controller."/"."index.php") && empty($this->_action))
				include(ROOT."view/".$this->_controller."/"."index.php");
			else
				require(ROOT."/view/error/404.php");
			
			//footer
			if(file_exists(ROOT."/view/".$this->_controller."/footer.php"))
				include(ROOT."/view/".$this->_controller."/footer.php");
			else
				include(ROOT."/view/footer.php");
				
		}
		
		//if a message needs to be displayed, it will need to do so outside this class.
		//this needs to be changed.
		public function RenderMsg($msg)
		{
			echo("<div id=\"messages\">");
			echo $msg;
			echo("</div>");
		}
		
		
		
		public function SetCSS()
		{
			global $session;
		
			$CSSLink = '<link rel="stylesheet" type="text/css" href="';
			$neutralColors = "include/css/neutralColors.css\" />";
			$adminColors = "include/css/adminColors.css\" />";
			$studentColors = "include/css/studentColors.css\" />";
			$instructorColors = "include/css/instructorColors.css\" />";
			$accreditorColors = "include/css/accreditorColors.css\" />";
	
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
